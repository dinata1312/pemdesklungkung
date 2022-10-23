<?php

namespace App\Repositories;

use App\Models\Form\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Question;
    }

    public function getWithMarker()
    {
        return $this->model::whereNotNull('marker')->get();
    }

    public function create(array $data)
    {
        if($this->withOption($data['type'])){
            $data['meta'] = json_encode(['option'=>$data['meta']]);
        }
        return $this->model::create($data);
    }

    public function update(array $data, int $id)
    {
        if($this->withOption($data['type'])){
            $data['meta'] = json_encode(['option'=>$data['meta']]);
        }
        $question = $this->model::find($id);
        if ($question) {
            $question->update($data);
            return $question;
        }
        return false;
    }

    public function withOption($type)
    {
        $show = False;
        $metaList = ['radio', 'select-one', 'select-multiple'];
        if(in_array($type,$metaList)){
            $show = True;
        }
        return $show;
    }

    public function getMarker($marker)
    {
        $marker = str_replace('%', '', $marker);
        $result = $this->model::where('marker',$marker)->first();
        if($result){
            return $result;
        }
        return false;
    }

}
