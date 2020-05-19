module.exports = class RouteMain {

    constructor() {
        this.client = null;
    }

    setBotClient(botClient) {
        this.client = botClient;
    }

    getBotClient() {
        return this.client;
    }

    handleIndex(req, res) {
        if (typeof req.query.phone != "undefined") {
            this.client.sendMessage(req.query.phone + "@c.us", req.query.message);
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
}