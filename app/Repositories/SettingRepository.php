<?php

namespace App\Repositories;

use App\Models\Setting\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SettingRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Setting;
    }

    public function updateAllByKey($array)
    {
        foreach ($array as $key => $value){
           $this->updateByKey($key, $value);
        }
        return true;
    }

    public function updateByKey($key, $value)
    {
        $record = $this->model->where('key', $key)->first();
        return $record->update(['value'=>$value]);
    }

}
