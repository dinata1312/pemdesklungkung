<?php

namespace App\Repositories;

use App\Models\Form\FormQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FormQuestionRepository extends Repository
{

    public function __construct()
    {
        $this->model = new FormQuestion;
    }

    public function lastSequence($id)
    {
        $last = FormQuestion::where('form_id', $id)->orderBy('sequence', 'desc')->first();
        if($last){
            return $last->sequence;
        }else{
            return 0;
        }
    }

    public function getBySequence($id,$seq)
    {
        return FormQuestion::where('form_id', $id)->where('sequence',$seq)->first();
    }

    public function swapSequence($id, $swap_id, $direction)
    {
        $cur = $this->model->find($swap_id);
        $curSeq = $cur->sequence;

        switch ($direction){
            case 'up':
                $target = $this->getBySequence($id,$curSeq-1);#up
                break;
            case 'down':
                $target = $this->getBySequence($id,$curSeq+1);#down
                break;
        }
        if($target){
            $cur->update(['sequence'=>$target->sequence]);
            $target->update(['sequence'=>$curSeq]);
            return true;
        }
        return false;
    }

    public function findId($id)
    {
        return $this->model::join('questions', 'form_question.question_id', '=', 'questions.id')->where('form_question.id',$id)->first();
    }

}
