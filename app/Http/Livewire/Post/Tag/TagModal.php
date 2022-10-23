<?php

namespace App\Http\Livewire\Post\Tag;

use Livewire\Component;
use App\Repositories\TagRepository;
use App\Models\Term;

class TagModal extends Component
{
    protected $listeners = [
            'showCreateTagModal' => 'showCreateModal',
            'showUpdateTagModal' => 'showUpdateModal',
            "saved"              => "refreshTable"
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

    public $term = [];
    public $termOptions;

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
            'term_id' => $this->term_id,
        ],$attributes);
    }

    public function showCreateModal()
    {
        $force = ($this->action == 'update') ? $this->loadModalContent(True) : false;
        $this->emit('clearSelected');
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
                $this->reset(['label','term_id']);
                break;
            case "update":
                $tagRepository = new TagRepository;
                $tag           = $tagRepository->find($this->modelId);
                $tagTerm       = [$tag->term_id];
                $this->label   = $tag->label;
                $this->term_id = $tag->term_id;
                $this->emit('clearSelected');
                $this->emit('setSelectedOption', [$tagTerm]);
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
            'term_id' => 'nullable'
        ];
    }

    public function create()
    {
        $tagRepository = new TagRepository;
        $this->validate();
        $tagRepository->create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $tagRepository = new TagRepository;
        $this->validate();
        $tagRepository->find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function mount()
    {
        $this->label;
        $this->term_id;
        $this->termOptions = eloquent_to_options(Term::get(), 'id', 'label');
        $this->button = create_button($this->action??'create', "Kategori");
    }

    public function refreshTable()
    {
        $this->reset(['termOptions']);
        $this->termOptions = eloquent_to_options(Term::get(), 'id', 'label');
        $this->render();
    }

    public function render()
    {
        return view('livewire.modal.post.tag-modal',[]);
    }

}
