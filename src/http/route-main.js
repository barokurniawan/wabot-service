const { MessageMedia } = require('whatsapp-web.js');
const axios = require('axios').default;

const fileToBase64 = async function (file) {
    let image = await axios.get(file, { responseType: 'arraybuffer' });
    let returnedB64 = Buffer.from(image.data).toString('base64');

    return returnedB64;
}

module.exports = class RouteMain {

    constructor() {
        this.client = null;
        this._qrcode = null;
        this.QRModule = null;
    }

    setBotClient(botClient) {
        this.client = botClient;
    }

    setQRCode(_qrcode) {
        this._qrcode = _qrcode;
    }

    setQRModule(QRCode) {
        this.QRModule = QRCode;
    }

    getBotClient() {
        return this.client;
    }

    getQRCode() {
        return this._qrcode;
    }

    getQRModule() {
        return this.QRModule;
    }

    async handleIndex(req, res) {
        if (typeof req.query.phone != "undefined") {
            if (typeof req.query.mime != "undefined" && typeof req.query.file != "undefined" && typeof req.query.filename != "undefined") {
                const chat = await this.client.getChatById(req.query.phone + "@c.us");
                chat.sendStateTyping();
                var media = new MessageMedia(req.query.mime, await fileToBase64(req.query.file), req.query.filename);

                if (req.query.message) {
                    this.client.sendMessage(req.query.phone + "@c.us", media, {
                        caption: req.query.message
                    });
                } else {
                    this.client.sendMessage(req.query.phone + "@c.us", media);
                }

                chat.clearState();
            } else {
                const chat = await this.client.getChatById(req.query.phone + "@c.us");
                chat.sendStateTyping();
                this.client.sendMessage(req.query.phone + "@c.us", req.query.message);
                chat.clearState();
            }
        }

        res.setHeader('Content-Type', 'Application/Json');
        res.send(JSON.stringify({
            info: true,
            status: 'send to queue',
            data: {
                message: req.query.message,
                target: req.query.phone
            }
        }));
    }

    handleDevice(req, res) {
        var state = null,
            webVersion = null,
            that = this;

        that.client.getState().then(function (result) {
            state = result;
            that.client.getWWebVersion().then(function (result) {
                webVersion = result;

                res.setHeader('Content-Type', 'Application/Json');
                res.send(JSON.stringify({
                    info: true,
                    state: state,
                    webVersion: webVersion,
                    device: that.client.info
                }));
            });
        });
    }

    handleScanner(req, res) {
        var _that = this;
        if (_that.getQRCode()) {
            _that.getQRModule().toDataURL(_that.getQRCode()).then(function (imgdata) {
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
    }
}