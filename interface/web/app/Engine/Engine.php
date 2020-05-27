<?php

namespace App\Engine;

use stdClass;
use GuzzleHttp\Client;

class Engine
{
    /**
     * @var string $base_uri
     */
    private $base_uri;

    /**
     * @var \GuzzleHttp\Client $httpClient
     */
    private $httpClient;

    /**
     * @var Engine $instance
     */
    private static $instance;

    public function __construct()
    {
        $this->setBaseUri(env('ENGINE_ADDRESS'));
        $this->setHttpClient(
            new Client([
                'base_uri' => $this->getBaseUri()
            ])
        );
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Send media such as pdf, image, etc, but video.
     */
    public function sendMediaMessage(string $targetPhone, string $mime, string $filename, string $fileAddess, string $message = '')
    {
        $client = $this->getHttpClient();
        $response = $client->post('/api/message', [
            'form_params' => [
                'phone'    => $targetPhone,
                'mime'     => $mime,
                'filename' => $filename,
                'file'     => $fileAddess,
                'message'  => $message
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            info('sendMediaMessage status code : ' . $response->getStatusCode());

            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        return json_decode($response->getBody());
    }

    /**
     * send a reqular message text
     */
    public function sendTextMessage(string $targetPhone, string $message)
    {
        $client = $this->getHttpClient();

        try {
            $response = $client->post('/api/message', [
                'form_params' => [
                    'phone'   => $targetPhone,
                    'message' => $message
                ]
            ]);
        } catch (\Throwable $th) {
            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        if ($response->getStatusCode() != 200) {
            info('sendTextMessage status code : ' . $response->getStatusCode());

            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        return json_decode($response->getBody());
    }

    /**
     * get a qrcode in base64 image source
     */
    public function getQRCode()
    {
        $client = $this->getHttpClient();
        $response = $client->get('/api/qr');

        if ($response->getStatusCode() != 200) {
            info('getQRCode status code : ' . $response->getStatusCode());

            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        return json_decode($response->getBody());
    }

    /**
     * get client device information
     */
    public function getDeviceInformation()
    {
        $client = $this->getHttpClient();
        $response = $client->get('/api/device');

        if ($response->getStatusCode() != 200) {
            info('getDeviceInformation status code : ' . $response->getStatusCode());

            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        return json_decode($response->getBody());
    }

    /**
     * get server status, useful to chek uptime after reseting engine
     */
    public function serverHealth()
    {
        $client = $this->getHttpClient();
        $response = $client->get('/api/health');

        if ($response->getStatusCode() != 200) {
            info('serverHealth status code : ' . $response->getStatusCode());

            return (object) [
                'info' => false,
                'status' => "Failed to create request to engine"
            ];
        }

        return json_decode($response->getBody());
    }

    /**
     * Restart the engine, this will make a downtime to engine for a second
     */
    public function resetEngine()
    {
        $client = $this->getHttpClient();

        try {
            $client->get('/api/device/reset');
        } catch (\Throwable $th) {
        }

        return (object) [
            'info' => true,
            'status' => "Reseting engine.."
        ];
    }

    /**
     * Get the value of base_uri
     *
     * @return mixed
     */
    public function getBaseUri()
    {
        return $this->base_uri;
    }

    /**
     * Set the value of base_uri
     *
     * @param   mixed  $base_uri  
     *
     * @return  self
     */
    public function setBaseUri($base_uri)
    {
        $this->base_uri = $base_uri;

        return $this;
    }

    /**
     * Get $httpClient
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Set $httpClient
     *
     * @param   \GuzzleHttp\Client  $httpClient  $httpClient
     *
     * @return  self
     */
    public function setHttpClient(\GuzzleHttp\Client $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}
