<?php

namespace App\Models;

use App\Lib\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";

    /**
     * @var self
     */
    private static $instance;

    /**
     * @var string
     */
    private $errorMessage;

    const STATUS_DISCONNECTED = "DISCONNECTED";
    const STATUS_CONNECTED = "CONNECTED";

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function advanceShowList(int $userID, QueryFilter $queryFilter)
    {
        $model = Service::where('user_id', $userID);
        if (!empty($queryFilter->getSearch())) {
            $model->where('whatsapp_number', 'like', '%' . $queryFilter->getSearch() . '%');
        }

        return $model->get();
    }

    public function countRows(int $userID, QueryFilter $queryFilter)
    {
        $model = Service::where('user_id', $userID);
        if (!empty($queryFilter->getSearch())) {
            $model->where('whatsapp_number', 'like', '%' . $queryFilter->getSearch() . '%');
        }

        return $model->count();
    }

    public function registerService(string $phone, int $userID)
    {
        $model = Service::where('user_id', $userID)->get();
        if ($model->count() > 3) {
            $this->setErrorMessage('Failed to create new service, limit reached.');
            return false;
        }

        $model = new Service;
        $model->whatsapp_number = $phone;
        $model->user_id = $userID;

        return (bool) $model->save();
    }

    public function setServiceStatus(string $whatsappNumber, string $client_status)
    {
        $model = Service::where('whatsapp_number', $whatsappNumber)->first();
        if (empty($model)) {
            $this->setErrorMessage('Service not found');
            return false;
        }

        $model->client_status = $client_status;
        return $model->save();
    }

    public function setErrorMessage(string $msg)
    {
        $this->errorMessage = $msg;
        return $this;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
