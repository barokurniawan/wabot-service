<?php

namespace App\Engine;

use Illuminate\Support\Facades\Http;

class Engine implements EngineBlueprint
{
    const END_POINT_REGISTRATION   = "/api/registration";
    const END_POINT_SENDER         = "/api/message";
    const END_POINT_DEVICE_INFO    = "/api/device";
    const END_POINT_QRCODE_FETCHER = "/api/qr";
    const END_POINT_SERVER_STATUS  = "/api/health";
    const END_POINT_LIST_USERS     = "/api/list-user";

    /**
     * @var Engine $instance
     */
    private static $instance;

    /**
     * @var string
     */
    private $engineAddress;

    public function __construct()
    {
        $this->engineAddress = config('engine.url');
    }

    /**
     * Get current service instance
     * @return self
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Send regular text message
     */
    public function sendMessage(MessageArgs $args)
    {
        $cl_check = Engine::escapePhoneNumber($args->getCl());
        if ($cl_check == false) {
            return (object) [
                'info' => false,
                'message' => "Invalid CL parameter"
            ];
        }

        $ph_check = Engine::escapePhoneNumber($args->getPhone());
        if ($ph_check == false) {
            return (object) [
                'info' => false,
                'message' => "Invalid phone number format"
            ];
        }

        $args->setCl($cl_check);
        $args->setPhone($ph_check);

        try {
            $response = Http::post($this->getEngineAddress() . Engine::END_POINT_SENDER, $args->toArray());
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    /**
     * send media message (image or document)
     */
    public function sendMedia(MediaArgs $args)
    {
        $cl_check = Engine::escapePhoneNumber($args->getCl());
        if ($cl_check == false) {
            return [
                'info' => false,
                'message' => "Invalid CL parameter"
            ];
        }

        $ph_check = Engine::escapePhoneNumber($args->getPhone());
        if ($ph_check == false) {
            return [
                'info' => false,
                'message' => "Invalid phone number format"
            ];
        }

        $args->setCl($cl_check);
        $args->setPhone($ph_check);
        $response = Http::post($this->getEngineAddress() . Engine::END_POINT_SENDER, $args->toArray());
    }

    /**
     * get client device info
     */
    public function getDeviceInfo(string $cl)
    {
        $response = "";
        $cl = Engine::escapePhoneNumber($cl);

        if ($cl == false) {
            return [
                'info' => false,
                'message' => "Invalid CL parameter"
            ];
        }

        try {
            $response = Http::get($this->getEngineAddress() . Engine::END_POINT_DEVICE_INFO, [
                'cl' => $cl
            ]);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    /**
     * get qrcode image
     */
    public function getQRCode(string $cl)
    {
        $response = "";
        $cl = Engine::escapePhoneNumber($cl);
        if ($cl == false) {
            return [
                'info' => false,
                'message' => "Invalid CL parameter"
            ];
        }

        try {
            $response = Http::get($this->getEngineAddress() . Engine::END_POINT_QRCODE_FETCHER, [
                'cl' => $cl
            ]);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    /**
     * get server status
     */
    public function getServerStatus()
    {
        $response = "";

        try {
            $response = Http::get($this->getEngineAddress() . Engine::END_POINT_SERVER_STATUS);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    /**
     * Get the value of engineAddress
     *
     * @return string
     */
    public function getEngineAddress()
    {
        return $this->engineAddress;
    }

    public function clientRegistration(string $phone)
    {
        $response = "";
        $phone = Engine::escapePhoneNumber($phone);

        if ($phone == false) {
            return (object) [
                'info' => false,
                'message' => "Invalid CL parameter"
            ];
        }

        try {
            $response = Http::get($this->getEngineAddress() . Engine::END_POINT_REGISTRATION, [
                'phone' => $phone
            ]);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    public function fetchConnectedUsers()
    {
        try {
            $response = Http::get($this->getEngineAddress() . Engine::END_POINT_LIST_USERS);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'message' => "Could not connect to the engine"
            ];
        }

        if (!$response->ok() || $response->serverError() || $response->clientError()) {
            return (object) [
                'info' => false,
                'message' => $response->body()
            ];
        }

        return json_decode($response->body());
    }

    public static function escapePhoneNumber(string $phone)
    {
        $phone = preg_replace("/[^0-9]/", "", trim($phone));
        $one_digit = substr($phone, 0, 1);
        $three_digit = substr($phone, 0, 3);

        if ($three_digit == "628") {
            return $phone;
        }

        if ($one_digit == '0') {
            $phone = substr($phone, 1);
            return self::escapePhoneNumber($phone);
        }

        if ($one_digit != '8') {
            return false;
        }

        return "62" . $phone;
    }
}
