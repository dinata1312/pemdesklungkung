<?php

namespace App\Repositories;

use App\Models\Setting\Section;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SectionRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Section;
    }

    public function updateAllByKey($arrayOption, $arrayTitle, $arrayMeta)
    {
        foreach ($arrayOption as $key => $valueOption){
           $this->updateByKey($key, $valueOption, $arrayTitle[$key], $arrayMeta[$key]??null);
        }
        return true;
    }

    public function updateByKey($key, $valueOption, $valueTitle, $valueMeta)
    {
        $record = $this->model->where('key', $key)->first();
        return $record->update(['content' => $valueOption, 'title' => $valueTitle, 'meta' => $valueMeta]);
    }

}
