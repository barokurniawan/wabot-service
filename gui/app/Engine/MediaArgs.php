<?php

namespace App\Engine;

class MediaArgs
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
     * message act like a caption here, but only applied on image message
     * @var string
     */
    private $message;

    /**
     * mime of the file
     * @var string
     */
    private $mime;

    /**
     * address on the file
     * @var string
     */
    private $file;

    /**
     * name of the file
     * @var string
     */
    private $filename;

    public function __construct(string $cl, string $phone, string $message, string $mime, string $file, string $filename)
    {
        $this->setCl($cl);
        $this->setPhone($phone);
        $this->setMessage($message);
        $this->setMime($mime);
        $this->setFile($file);
        $this->setFilename($filename);
    }

    public function toArray()
    {
        return [
            "cl"       => $this->getCl(),
            "phone"    => $this->getPhone(),
            "message"  => $this->getMessage(),
            "mime"     => $this->getMime(),
            "file"     => $this->getFile(),
            "filename" => $this->getFilename(),
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
     * Get message act like a caption here, but only applied on image message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message act like a caption here, but only applied on image message
     *
     * @param   string  $message  message act like a caption here, but only applied on image message
     *
     * @return  self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get mime of the file
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set mime of the file
     *
     * @param   string  $mime  mime of the file
     *
     * @return  self
     */
    public function setMime(string $mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get address on the file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set address on the file
     *
     * @param   string  $file  address on the file
     *
     * @return  self
     */
    public function setFile(string $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get name of the file
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set name of the file
     *
     * @param   string  $filename  name of the file
     *
     * @return  self
     */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;

        return $this;
    }
}
