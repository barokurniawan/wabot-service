<?php

namespace App\Jobs;

use App\Engine\Engine;

class SendTextMessage extends Job
{
    private $phone, $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $phone, string $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $engine = Engine::getInstance();
        $engine->sendTextMessage($this->phone, $this->message);
    }
}
