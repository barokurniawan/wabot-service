let constant = {
    status_code: {
        MISSING_REQUIRED_ARGS: 403,

        CLIENT_IS_REGISTERED: 101,
        CLIENT_IS_NOT_EXISTS: 104,
        CLIENT_IS_NOT_READY: 105,
        CLIENT_CONNECTED: 100,

        QRCODE_READY: 200,
    }
};

module.exports = Object.freeze(constant);