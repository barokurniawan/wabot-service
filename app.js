const { Client } = require('whatsapp-web.js');
const fs = require('fs');
const util = require('util');
const express = require('express');
const RouteMain = require('./src/http/route-main');

const app = express();
const port = 3002;
const host = "0.0.0.0";

const SESSION_FILE_PATH = './bot-session.json';
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
    sessionCfg = require(SESSION_FILE_PATH);
}

const client = new Client({ puppeteer: { headless: true, args: ['--no-sandbox'] }, session: sessionCfg });

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
});

client.on('qr', (qr) => {
    // Generate and scan this code with your phone
    console.log('QR RECEIVED', qr);
});

client.on('ready', () => {
    console.log('Client is ready!');
});

client.on('message', async msg => {
    console.log(util.format("incoming message from %s : %s", msg.from, msg.body));
    if (msg.body == '!ping') {
        const chat = await msg.getChat();
        chat.sendStateTyping();
        client.sendMessage(msg.from, 'pong');
        chat.clearState();
    } else {
        const chat = await msg.getChat();
        chat.sendStateTyping();
        client.sendMessage(msg.from, 'Perintah tidak diketahui');
        chat.clearState();
    }
});

const routeMain = new RouteMain();
routeMain.setBotClient(client);

//define route request
app.get('/', routeMain.handleIndex.bind(routeMain));
app.get('/device', routeMain.handleDevice.bind(routeMain));

//start whatsapp client engine 
client.initialize();

//start http server 
app.listen(port, host, () => console.log(`Example app listening at http://localhost:${port}`))