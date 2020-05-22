const { Client } = require('whatsapp-web.js');
const fs = require('fs');
const util = require('util');
const express = require('express');
const RouteMain = require('./src/http/route-main');
const QRCode = require('qrcode');

const app = express();
const port = 3002;
const host = "0.0.0.0";

const SESSION_FILE_PATH = './bot-session.json';
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
    sessionCfg = require(SESSION_FILE_PATH);
}

const client = new Client({ puppeteer: { headless: true, args: ['--no-sandbox'] }, session: sessionCfg });
const routeMain = new RouteMain();
routeMain.setBotClient(client);
routeMain.setQRModule(QRCode);

client.on('authenticated', (session) => {
    console.log('AUTHENTICATED', session);
    sessionCfg = session;
    fs.writeFile(SESSION_FILE_PATH, JSON.stringify(session), function (err) {
        if (err) {
            console.error(err);
        }
    });
});

client.on('auth_failure', msg => {
    // Fired if session restore was unsuccessfull
    console.error('AUTHENTICATION FAILURE', msg);

    // remove current session file
    fs.unlinkSync(SESSION_FILE_PATH);

    //destroy client instant 
    client.destroy().then(function () {
        /*
            we are using docker with restart:always, exit the 
            system to make container reboot, so we get a new fresh copy
            remember, there is a downtime.
        */
        process.exit(1);
    });
});

client.on('qr', (qr) => {
    // Generate and scan this code with your phone
    routeMain.setQRCode(qr);
    console.log("QR is ready");
});

client.on('ready', () => {
    routeMain.setQRCode(null);
    console.log('Client is ready!');
});

client.on('message', async msg => {
    console.log(util.format("incoming message from %s : %s", msg.from, msg.body));
    if (msg.body == '!ping') {
        const chat = await msg.getChat();
        chat.sendStateTyping();
        client.sendMessage(msg.from, 'pong');
        chat.clearState();
    }
});

//define route request
app.get('/', routeMain.handleIndex.bind(routeMain));
app.get('/device', routeMain.handleDevice.bind(routeMain));
app.get('/qr/scan', routeMain.handleScanner.bind(routeMain));

//reset will remove session so we need to scan new qrcode
app.get('/api/reset', function (req, res) {
    // remove current session file
    fs.unlinkSync(SESSION_FILE_PATH);

    //destroy client instant 
    client.destroy().then(function () {
        /*
            we are using docker with restart:always, exit the 
            system to make container reboot, so we get a new fresh copy
            remember, there is a downtime.
        */
        process.exit(1);
    });
});

//cek server status, to check uptime after downtime
app.get('/api/health', function (req, res) {
    res.setHeader('Content-Type', 'Application/Json');
    res.send(JSON.stringify({
        info: true,
        status: 'server is up'
    }));
});

//start whatsapp client engine 
client.initialize();

//start http server 
app.listen(port, host, () => console.log(`listening at http://${host}:${port}`))