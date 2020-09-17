<?php

namespace App\Engine;

interface EngineBlueprint
{
    /**
     * Get current service instance
     * @return self
     */
    public static function getInstance();

    /**
     * Send regular text message
     */
    public function sendMessage(MessageArgs $args);

    /**
     * send media message (image or document)
     */
    public function sendMedia(MediaArgs $args);

    /**
     * get client device info
     */
    public function getQRCode(string $cl);

    /**
     * get client device info
     */
    public function getDeviceInfo(string $cl);

    /**
     * handle client registration
     */
    public function clientRegistration(string $phone);

    /**
     * get server status
     */
    public function getServerStatus();

    /**
     * get server status
     */
    public function fetchConnectedUsers();
}
