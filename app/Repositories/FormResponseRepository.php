<?php

namespace App\Repositories;

use App\Models\Form\FormResponse;
use App\Models\Form\FormRespondent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormResponseRepository extends Repository
{

    public function __construct()
    {
        $this->model = new FormResponse;
        $this->formRespondent = new FormRespondent;
    }

    public function checkRespondent(array $data)
    {
        $respondent = $this->formRespondent::where('user_id',$data['user_id'])->where('form_id',$data['form_id'])->first();
        if($respondent){
            return $respondent;
        }else{
            return $this->formRespondent::create($data);
        }
    }

    public function store(array $data)
    {
        return $this->model::create($data);
    }

}
