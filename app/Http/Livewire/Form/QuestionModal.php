<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use App\Models\Form\Question;
use App\Repositories\QuestionRepository;

class QuestionModal extends Component
{
    protected $listeners = [
        'showCreateModal' => 'showCreateModal',
        'showUpdateModal' => 'showUpdateModal',
        ];

    public $model;
    public $name;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    // Model Attribute
    public $label;
    public $type="text";
    public $placeholder;
    public $marker;
    public $meta;
    public $required = 0;

    public $inputFields = [0];
    public $inputAmount = 1;

    public function addField($i)
    {
        $this->inputAmount = $i+1;
        array_push($this->inputFields ,$i);
    }
    public function removeField($i)
    {
        unset($this->inputFields[$i]);
        unset($this->meta[$i]);
    }

    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];
        return array_merge([
            'label'       => $this->label,
            'type'        => $this->type,
            'placeholder' => $this->placeholder,
            'marker'      => $this->marker,
            'meta'        => $this->meta,
            'required'    => $this->required,
        ],$attributes);
    }

    public function showCreateModal()
    {
        $force = ($this->action == 'update') ? $this->loadModalContent(True) : false;
        $this->action = "create";
        $this->resetValidation();
        $this->modelId = null;
        $this->modalFormVisible = true;
    }

    public function showUpdateModal($id)
    {
        $this->action = "update";
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModalContent();
    }

    public function loadModalContent($refresh = False)
    {
        $this->action = ($refresh)? "create" : $this->action;
        $this->button = create_button($this->action, "Pertanyaan");
        switch ($this->action){
            case "create":
                $this->reset(['label','type','placeholder','marker','meta','required','inputFields','inputAmount']);
                break;
            case "update":
                $questionRepository = new QuestionRepository;
                $question           = $questionRepository->find($this->modelId);
                $this->label        = $question->label;
                $this->type         = $question->type;
                $this->placeholder  = $question->placeholder;
                $this->required     = $question->required;
                $this->marker       = $question->marker;
                if($this->withOption($this->type)){
                    $this->reset(['meta','inputFields','inputAmount']);
                    $meta   = json_decode($question->meta,true);
                    $option = $meta['option'];
                    $this->inputAmount = count($option);
                    for ($i=1; $i < $this->inputAmount; $i++) {
                        array_push($this->inputFields,$i);
                    }
                    $this->meta = $option;
                }
                break;
        }
    }

    /* The validation rules
    *
    * @return void
    */
   public function rules()
   {
       return [
           'label'       => 'required',
           'type'        => 'required',
           'placeholder' => 'nullable',
           'marker'      => 'nullable',
           'meta'        => 'nullable',
           'required'    => 'nullable',
       ];
   }

    public function create()
    {
        $questionRepository = new QuestionRepository;
        $this->validate();
        $question = $questionRepository->create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
        $this->emit('questionCreated', id_enc($question->id,'q'));
        $this->loadModalContent();
    }

    public function update()
    {
        $questionRepository = new QuestionRepository;
        $this->validate();
        $questionRepository->update($this->modelData(),$this->modelId);
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function withOption($type)
    {
        $show = False;
        $metaList = ['radio', 'select-one', 'select-multiple'];
        if(in_array($type,$metaList)){
            $show = True;
        }else{
            $this->reset(['meta','inputFields','inputAmount']);
        }
        return $show;
    }

    public function mount()
    {
        $this->label;
        $this->type;
        $this->placeholder;
        $this->marker;
        $this->required;
        $this->meta;
        $this->button = create_button($this->action??'create', "Pertanyaan");
    }

    public function render()
    {
        return view('livewire.modal.form.question-modal');
    }
}
