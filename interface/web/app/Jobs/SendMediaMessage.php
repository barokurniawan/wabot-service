<?php

namespace App\Jobs;

use App\Engine\Engine;

class SendMediaMessage extends Job
{
    private $phone, $message, $mime, $fileAddress, $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $phone, string $mime, string $filename, string $fileAddess, string $message = null)
    {
        $this->phone       = $phone;
        $this->mime        = $mime;
        $this->filename    = $filename;
        $this->fileAddress = $fileAddess;
        $this->message     = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $engine = Engine::getInstance();
        $engine->sendMediaMessage(
            $this->phone,
            $this->mime,
            $this->filename,
            $this->fileAddress,
            $this->message
        );
    }
}
