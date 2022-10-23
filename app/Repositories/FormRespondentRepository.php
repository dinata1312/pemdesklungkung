<?php

namespace App\Repositories;

use App\Models\Form\FormRespondent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormRespondentRepository extends Repository
{

    public function __construct()
    {
        $this->model = new FormRespondent;
        $this->formRespondent = new FormRespondent;
    }

}
