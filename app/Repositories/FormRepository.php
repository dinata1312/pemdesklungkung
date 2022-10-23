<?php

namespace App\Repositories;

use App\Models\Form\Form;
use App\Models\Form\FormQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Form;
    }

    public function create(array $data)
    {
        if(isset($data['slug'])){
            $data['slug'] = urlencode($data['slug']);
        }
        return $this->model::create($data);
    }

    public function questionId($id)
    {
        return $this->model->find($id)->formQuestions;
    }

    public function questions($id)
    {
        return FormQuestion::where('form_id', $id)->orderBy('sequence', 'asc')->get();
    }

}
