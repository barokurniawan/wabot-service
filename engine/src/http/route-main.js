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
        this.clientReady = false;
        this._qrcode = null;
        this.QRModule = null;
    }

    isClientReady(status) {
        this.clientReady = status;
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
        var _that = this,
            data = req.query;

        if (req.method == "POST") {
            data = req.body;
        }

        res.setHeader('Content-Type', 'Application/Json');
        if (_that.clientReady == false) {
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not ready'
            }));
            return;
        }

        if (typeof data.phone != "undefined") {
            if (typeof data.mime != "undefined" && typeof data.file != "undefined" && typeof data.filename != "undefined") {
                const chat = await this.client.getChatById(data.phone + "@c.us");
                chat.sendStateTyping();
                var media = new MessageMedia(data.mime, await fileToBase64(data.file), data.filename);

                if (data.message) {
                    this.client.sendMessage(data.phone + "@c.us", media, {
                        caption: data.message
                    });
                } else {
                    this.client.sendMessage(data.phone + "@c.us", media);
                }

                chat.clearState();
            } else {
                const chat = await this.client.getChatById(data.phone + "@c.us");
                chat.sendStateTyping();
                this.client.sendMessage(data.phone + "@c.us", data.message);
                chat.clearState();
            }
        }

        res.send(JSON.stringify({
            info: true,
            status: 'send to queue',
            data: {
                message: data.message,
                target: data.phone
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

    async handleScanner(req, res) {
        var _that = this;
        if (_that.getQRCode()) {
            var base64 = await _that.getQRModule().toDataURL(_that.getQRCode());

            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: true,
                data: {
                    base64: base64
                },
                status: "QR is ready"
            }));
        } else {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: true,
                status: "Device is already connected"
            }));
        }
    }
}