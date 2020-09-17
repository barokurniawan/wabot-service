<?php

namespace App\Engine;

class MessageArgs
{
    /**
     * the client phone number
     * @var string
     */
    private $cl;

    /**
     * Phone number of receiver
     * @var string
     */
    private $phone;

    /**
     * The message to be sent
     * @var string
     */
    private $message;

    public function __construct(string $cl, string $phone, string $message)
    {
        $this->setCl($cl);
        $this->setMessage($message);
        $this->setPhone($phone);
    }

    public function toArray()
    {
        return [
            "cl"      => $this->getCl(),
            "phone"   => $this->getPhone(),
            "message" => $this->getMessage()
        ];
    }

    /**
     * Get the client phone number
     *
     * @return string
     */
    public function getCl()
    {
        return $this->cl;
    }

    /**
     * Set the client phone number
     *
     * @param   string  $cl  the client phone number
     *
     * @return  self
     */
    public function setCl(string $cl)
    {
        $this->cl = $cl;

        return $this;
    }

    /**
     * Get phone number of receiver
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone number of receiver
     *
     * @param   string  $phone  Phone number of receiver
     *
     * @return  self
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the message to be sent
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the message to be sent
     *
     * @param   string  $message  The message to be sent
     *
     * @return  self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
