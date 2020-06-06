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
        this.clientReady = [];
        this._qrcode = [];
        this.QRModule = null;
    }

    generateID(phone) {
        return phone + "@c.us";
    }

    isClientExists(USER_ID) {
        return typeof this.client[USER_ID] == 'undefined' ? false : true;
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

    getQRCode(cl) {
        return this._qrcode[cl] == undefined ? null : this._qrcode[cl];
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

        if (typeof data.cl == 'undefined') {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: false,
                status: "CL is required"
            }));
        }

        var USER_ID = _that.generateID(data.cl);
        if (!_that.isClientExists(USER_ID)) {
            res.setHeader('Content-Type', 'Application/Json');
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not exists'
            }));
            return;
        }

        res.setHeader('Content-Type', 'Application/Json');
        if (_that.clientReady[USER_ID] == false) {
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not ready'
            }));
            return;
        }

        if (typeof data.phone != "undefined") {
            if (typeof data.mime != "undefined" && typeof data.file != "undefined" && typeof data.filename != "undefined") {
                const chat = await this.client[USER_ID].getChatById(data.phone + "@c.us");
                chat.sendStateTyping();
                var media = new MessageMedia(data.mime, await fileToBase64(data.file), data.filename);

                if (data.message) {
                    this.client[USER_ID].sendMessage(data.phone + "@c.us", media, {
                        caption: data.message
                    });
                } else {
                    this.client[USER_ID].sendMessage(data.phone + "@c.us", media);
                }

                chat.clearState();
            } else {
                const chat = await this.client[USER_ID].getChatById(data.phone + "@c.us");
                chat.sendStateTyping();
                this.client[USER_ID].sendMessage(data.phone + "@c.us", data.message);
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
            that = this,
            querySTR = req.query;

        if (typeof querySTR.cl == 'undefined') {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: false,
                status: "CL is required"
            }));
        }

        var USER_ID = that.generateID(querySTR.cl);
        if (!that.isClientExists(USER_ID)) {
            res.setHeader('Content-Type', 'Application/Json');
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not exists'
            }));
            return;
        }

        if (that.clientReady[USER_ID] == false) {
            res.setHeader('Content-Type', 'Application/Json');
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not ready'
            }));

            return;
        }

        that.client[USER_ID].getState().then(function (result) {
            state = result;
            that.client[USER_ID].getWWebVersion().then(function (result) {
                webVersion = result;

                res.setHeader('Content-Type', 'Application/Json');
                res.send(JSON.stringify({
                    info: true,
                    state: state,
                    webVersion: webVersion,
                    device: that.client[USER_ID].info
                }));
            });
        });
    }

    async handleScanner(req, res) {
        var _that = this,
            querySTR = req.query;

        if (typeof querySTR.cl == 'undefined') {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: false,
                status: "CL is required"
            }));
        }

        var USER_ID = _that.generateID(querySTR.cl);
        if (!_that.isClientExists(USER_ID)) {
            res.setHeader('Content-Type', 'Application/Json');
            res.send(JSON.stringify({
                info: false,
                status: 'Client is not exists'
            }));
            return;
        }

        var qr = _that.getQRCode(USER_ID);
        if (qr) {
            var base64 = await _that.getQRModule().toDataURL(qr);
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: true,
                data: {
                    base64: base64
                },
                status: "QR is ready"
            }));
        } else if (qr === null) {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: false,
                status: "Device is not registered"
            }));
        } else {
            res.setHeader("Content-Type", "Application/Json");
            res.status(200).send(JSON.stringify({
                info: false,
                status: "Device is already connected"
            }));
        }
    }
}