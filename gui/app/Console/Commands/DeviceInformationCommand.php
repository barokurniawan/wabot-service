<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DeviceInformationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'device:update_info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Device Information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Service::all() as $service) {
            $res = Http::get('http://wabot_web/api/device', [
                'phone' => $service->whatsapp_number
            ]);

            if ($res->ok()) {
                $service = Service::find($service->id);
                if (empty($service)) {
                    continue;
                }

                $content = json_decode($res->body());
                if ($content->info == false) {
                    $service->client_status = Service::STATUS_DISCONNECTED;
                    $service->save();
                } else {
                    $service->webVersion = $content->webVersion;
                    $service->pushname = $content->device->pushname;
                    $service->server = $content->device->me->server;
                    $service->user = $content->device->me->user;
                    $service->_serialized = $content->device->me->_serialized;
                    $service->wa_version = $content->device->phone->wa_version;
                    $service->os_version = $content->device->phone->os_version;
                    $service->device_manufacturer = $content->device->phone->device_manufacturer;
                    $service->device_model = $content->device->phone->device_model;
                    $service->os_build_number = $content->device->phone->os_build_number;
                    $service->platform = $content->device->platform;
                    $service->client_status = $content->state;

                    $service->save();
                }
            }
        }
    }
}
