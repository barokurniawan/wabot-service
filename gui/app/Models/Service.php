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

        return (bool) $model->save();
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
