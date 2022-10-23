<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Form\Form;
use App\Repositories\FormRepository;
use App\Repositories\DocumentRepository;
use Carbon\Carbon;

class FormModal extends Component
{
    protected $listeners = [
        'showCreateModal' => 'showCreateModal',
        'showUpdateModal' => 'showUpdateModal',
        'showConnectModal' => 'showConnectModal',
        'showPreviewModal' => 'showPreviewModal',
        ];

    public $model;
    public $cname;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    // Model Attribute
    public $name;
    public $desc;
    public $closed;
    public $slug;
    public $open_time;
    public $close_time;

    //connect
    public $document;
    public $documentOption;
    public $documentTags=[];

    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];
        return array_merge([
            'name'   => $this->name,
            'desc'   => $this->desc,
            'closed' => $this->closed,
            'slug'   => $this->slug,
            'open_time'  => $this->open_time,
            'close_time' => $this->close_time,
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

    public function showConnectModal($id)
    {
        $this->action = "connect";
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModalContent();
    }

    public function showPreviewModal($id)
    {
        $this->action = "preview";
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModalContent();
    }

    public function loadModalContent($refresh = False)
    {
        $this->action = ($refresh)? "create" : $this->action;
        $this->button = create_button($this->action, "Navigasi");
        switch ($this->action){
            case "create":
                $this->reset(['name','desc','closed','slug','open_time','close_time']);
                break;
            case "update":
                $formRepository = new FormRepository;
                $form         = $formRepository->find($this->modelId);
                $this->name   = $form->name;
                $this->desc   = $form->desc;
                $this->closed = $form->closed;
                $this->slug   = $form->slug;
                $this->emit('setText', ['desc', $this->desc]);
                $this->open_time  = !is_null($form->open_time)? Carbon::parse($form->open_time)->format('Y-m-d\TH:i') : null;
                $this->close_time = !is_null($form->close_time)? Carbon::parse($form->close_time)->format('Y-m-d\TH:i') : null;
                break;
            case "connect":
                $documentRepository = new DocumentRepository;
                $documentTags = $documentRepository->getWithNoForm();
                $this->reset(['documentTags']);
                $this->emit('clearSelected');
                $this->emit('setSelectedOption', [$documentTags, 'id']);
                $this->documentOption = eloquent_to_options($documentRepository->getWithNoForm(), 'id', 'title');
                break;
            case "preview":
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
           'name'       => 'required',
           'desc'       => 'required',
           'closed'     => 'nullable',
           'slug'       => ['nullable', Rule::unique('forms', 'slug')->ignore($this->modelId),'alpha_dash'],
           'open_time'  => 'nullable|date',
           'close_time' => 'nullable|date|after:open_time',
       ];
   }

    public function create()
    {
        $formRepository = new FormRepository;
        $this->validate();
        $formRepository->create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $formRepository = new FormRepository;
        $this->validate();
        $formRepository->find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function connect()
    {
        $documentRepository = new DocumentRepository;
        $documentRepository->update([
                'form_id' => $this->modelId
            ],$this->document);
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function mount()
    {
        $this->name;
        $this->desc;
        $this->closed;
        $this->open_time;
        $this->close_time;
        $this->button = create_button($this->action??'create', "Formulir");
    }

    public function render()
    {
        return view('livewire.modal.form.form-modal');
    }
}
