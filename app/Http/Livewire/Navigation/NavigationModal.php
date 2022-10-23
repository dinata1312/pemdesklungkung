<?php

namespace App\Http\Livewire\Navigation;

use Livewire\Component;
use App\Models\Navigation;
use App\Repositories\NavigationRepository;

class NavigationModal extends Component
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
    public $link;
    public $child_of;
    public $sequence;

    public $navigationParent = [];
    public $navigationOptionParents;

    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];
        $this->link = empty($this->link) ? '#' : $this->link;
        return array_merge([
            'label'    => $this->label,
            'slug'     => $this->link,
            'child_of' => $this->child_of,
            'sequence' => $this->sequence,
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

    public function loadModalContent($refresh = False)
    {
        $this->action = ($refresh)? "create" : $this->action;
        $this->button = create_button($this->action, "Navigasi");
        switch ($this->action){
            case "create":
                $this->reset(['label','link','child_of','sequence']);
                break;
            case "update":
                $navigationRepository = new NavigationRepository;
                $nav       = $navigationRepository->find($this->modelId);
                $navParent = [$navigationRepository->parentId($this->modelId)];
                $this->label    = $nav->label;
                $this->link     = $nav->slug;
                $this->child_of = $nav->child_of;
                $this->sequence = $nav->sequence;
                $this->emit('clearSelected');
                $this->emit('setSelectedOption', [$navParent]);
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
           'label'    => 'required',
           'link'     => 'nullable|url',
           'child_of' => 'nullable',
           'sequence' => 'nullable'
       ];
   }

    public function create()
    {
        $navigationRepository = new NavigationRepository;
        $this->validate();
        $this->sequence = $navigationRepository->lastSequence()+1;
        $navigationRepository->create($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $navigationRepository = new NavigationRepository;
        $this->validate();
        $navigationRepository->find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->emit('saved');
    }

    public function mount()
    {
        $this->label;
        $this->link;
        $this->child_of;
        $this->sequence;
        $this->navigationOptionParents = eloquent_to_options(Navigation::whereNull('child_of')->get(), 'id', 'label');
        $this->button = create_button($this->action??'create', "Navigasi");
    }

    public function render()
    {
        return view('livewire.modal.navigation-modal');
    }
}
