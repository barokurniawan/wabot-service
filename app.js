const { Client } = require('whatsapp-web.js');
const fs = require('fs');
const util = require('util');
const express = require('express');
const RouteMain = require('./src/http/route-main');
var QRCode = require('qrcode')

const app = express();
const port = 3002;
const host = "0.0.0.0";

var _qrcode = null;

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

    fs.unlinkSync(SESSION_FILE_PATH);

    client.destroy();
    process.exit(1);
});

client.on('qr', (qr) => {
    // Generate and scan this code with your phone
    _qrcode = qr;
    console.log("QR is ready");
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

app.get('/qr/scan', function (req, res) {
    if (_qrcode) {
        QRCode.toDataURL(_qrcode).then(function (imgdata) {
            res.setHeader("Content-Type", "text/html");
            res.status(200).write(`<html>
                <head>
                    <title>Scan this qrcode</title>
                    <meta name="viewport" content="width=device-width">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <style>
                        body, html{
                            margin: 0; padding: 0;
                            width: 100%; height: 100%;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    <img style="margin-top: 10%;" src="`+ imgdata + `">
                </body>
            </html>`);
        });
    } else {
        res.setHeader("Content-Type", "Application/Json");
        res.status(200).send(JSON.stringify({
            info: true,
            status: "Device is already connected"
        }));
    }
});

//start whatsapp client engine 
client.initialize();

//start http server 
app.listen(port, host, () => console.log(`Example app listening at http://localhost:${port}`))