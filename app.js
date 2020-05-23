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

let client = new Client({ puppeteer: { headless: true, args: ['--no-sandbox'] }, session: sessionCfg });
const routeMain = new RouteMain();
routeMain.setBotClient(client);
routeMain.setQRModule(QRCode);

client.on('disconnected', (reason) => {
    console.log('Client was logged out', reason);

    if (fs.existsSync(SESSION_FILE_PATH)) {
        // remove current session file
        fs.unlinkSync(SESSION_FILE_PATH);
        sessionCfg = null;
    }

    routeMain.isClientReady(false);

    //destroy client instant 
    client.destroy().then(function () {
        console.log('Client is shutdown..');
        //start whatsapp client engine 
        client.initialize().then(function () {
            console.log('Fresh copy is ready..');
        });
    });
});

client.on('authenticated', (session) => {
    console.log('login sucess..');
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
    sessionCfg = null;

    //destroy client instant 
    client.destroy().then(function () {
        console.log('Client is shutdown..');
        //start whatsapp client engine 
        client.initialize().then(function () {
            console.log('Fresh copy is ready..');
        });
    });
});

client.on('qr', (qr) => {
    // Generate and scan this code with your phone
    routeMain.setQRCode(qr);
    console.log("qrcode is ready..");
});

client.on('ready', () => {
    routeMain.setQRCode(null);
    routeMain.isClientReady(true);
    console.log('Client is ready..');
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
app.post('/', routeMain.handleIndex.bind(routeMain));
app.post('/device', routeMain.handleDevice.bind(routeMain));
app.get('/qr/scan', routeMain.handleScanner.bind(routeMain));

//reset will remove session so we need to scan new qrcode
app.get('/api/reset', function (req, res) {
    if (fs.existsSync(SESSION_FILE_PATH) == false || routeMain.clientReady == false) {
        res.setHeader('Content-Type', 'Application/Json');
        res.send(JSON.stringify({
            info: false,
            status: 'Reset a non ready client is illegal.'
        }));

        return;
    }

    console.log('Shuting down the client..');
    // remove current session file
    fs.unlinkSync(SESSION_FILE_PATH);
    sessionCfg = null;

    //the best solution for reseting client is reset the container it self
    process.exit(1);
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
client.initialize().catch(function (err) {
    console.error(err);
});

//start http server 
app.listen(port, host, () => console.log(`listening at http://${host}:${port}`));