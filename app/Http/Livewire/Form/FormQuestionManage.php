<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Form\Question;
use App\Repositories\FormRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\FormQuestionRepository;
use Carbon\Carbon;

class FormQuestionManage extends Component
{
    public $model;

    protected $listeners = [
            'questionCreated' => 'addNew',
            'addExisting'     => 'addExisting',
            'saved'           => 'render'
        ];

    public $reuse = False;
    public $existing;
    public $question = [];
    public $questions;

    public function refreshContent()
    {
        $this->mount();
        $this->render();
    }

    public function mount()
    {
        $formRepository = new FormRepository;
        $this->model;
        $this->reuse;
        $this->question = eloquent_to_selected($formRepository->questionId($this->model->id));
        $this->questions = $formRepository->questions($this->model->id);
    }

    public function rmQuestion($idx)
    {
        $rm = id_dec($idx,'q');
        unset($this->question[$rm]);
        $this->question = array_values($this->question);
        //remove FormQuestion
        $FQRepository = new FormQuestionRepository;
        $FQRepository->find($rm)->delete();
        $this->refreshContent();
    }

    public function addNew($id)
    {
        $add = id_dec($id,'q');
        array_push($this->question, $add);
        //add Form Question
        $FQRepository = new FormQuestionRepository;
        $last = $FQRepository->lastSequence($this->model->id);
        $FQRepository->create([
            'form_id' => $this->model->id,
            'question_id' => $add,
            'sequence' => $last+1
        ]);
        $this->refreshContent();
    }

    public function swapQuestion($direction, $key)
    {
        $FQRepository = new FormQuestionRepository;
        $id = id_dec($key,'q');
        $FQRepository->swapSequence($this->model->id,$id,$direction);
        $this->refreshContent();
    }

    public function addExisting()
    {
        $marker = $this->existing;
        if($marker != null){
            $questionRepository = new QuestionRepository;
            $add = $questionRepository->getMarker($marker);
            if($add){
                if(!in_array($add->id, $this->question)){
                    array_push($this->question, $add->id);
                    //add Form Question
                    $FQRepository = new FormQuestionRepository;
                    $last = $FQRepository->lastSequence($this->model->id);
                    $FQRepository->create([
                        'form_id' => $this->model->id,
                        'question_id' => $add->id,
                        'sequence' => $last+1
                    ]);
                }
                $this->reset(['reuse','existing']);
                $this->refreshContent();
                $this->reuse = False;
            }
        }
    }

    public function render()
    {
        return view('livewire.modal.form.form-question-manage');
    }
}
