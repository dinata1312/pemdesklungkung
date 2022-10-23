<?php

namespace App\Http\Livewire\Post\Tag;

use Livewire\Component;
use App\Repositories\TermRepository;
use App\Models\Term;

class TermModal extends Component
{
    protected $listeners = [
        'showCreateTermModal' => 'showCreateModal',
        'showUpdateTermModal' => 'showUpdateModal',
        ];

    public $model;
    public $name;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    // Model Attribute
    public $label;
    public $term_id;

    /**
     * Properties that Store Form Inputs
     *
     * @return Array
     */
    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];

        return array_merge([
            'label' => $this->label,
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

    /**
     * Reload Form Input
     *
     * @param  mixed $refresh
     * @return void
     */
    public function loadModalContent($refresh = False)
    {
        $this->action = ($refresh)? "create" : $this->action;
        $this->button = create_button($this->action, "Pengumuman");
        switch ($this->action){
            case "create":
                $this->reset(['label']);
                break;
            case "update":
                $termRepository = new TermRepository;
                $term           = $termRepository->find($this->modelId);
                $this->label    = $term->label;
                break;
        }
    }

    /**
     * The validation rules
     *
     * @return void
     */
    public function rules()
    {
        return [
            'label'   => 'required',
        ];
    }

    public function create()
    {
        $termRepository = new TermRepository;
        $this->validate();
        $termRepository->create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $termRepository = new TermRepository;
        $this->validate();
        $termRepository->find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function mount()
    {
        $this->label;
        $this->button = create_button($this->action??'create', "Topik");
    }

    public function render()
    {
        return view('livewire.modal.post.term-modal',[]);
    }

}
