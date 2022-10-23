<?php

namespace App\Http\Livewire\Privilage;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Permission;

class PermissionModal extends Component
{
    public $model;
    public $name;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    public $inputFields = [0];
    public $inputAmount = 1;

    // Model Attribute
    public $perm_name;
    public $guard_name;

    protected $listeners = [
        "showCreateModal" => "showCreateModal",
        "showUpdateModal" => "showUpdateModal",
    ];

    public function addField($i)
    {
        $this->inputAmount = $i+1;
        array_push($this->inputFields ,$i);
    }
    public function removeField($i)
    {
        unset($this->inputFields[$i]);
    }

    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];

        return array_merge([
            'name' => $this->perm_name,
            'guard_name' => $this->guard_name??'web',
        ],$attributes);
    }

    public function showCreateModal()
    {
        $force = ($this->action == 'update') ? $this->loadModalContent(True) : false;
        $this->action = "create";
        $this->resetValidation();
        $this->reset(['inputFields','inputAmount']);
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
        $this->button = create_button($this->action, "Wewenang");
        switch ($this->action){
            case "create":
                $this->reset(['perm_name','guard_name']);
                break;
            case "update":
                $perm = Permission::find($this->modelId);
                $this->perm_name    = $perm->name;
                $this->guard_name     = $perm->guard_name;
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
            'perm_name'   => 'min:1',
            'perm_name.*' => ['required',Rule::unique('permissions', 'name')->ignore($this->modelId)],
            'guard_name'  => 'nullable'
        ];
    }

    public function create()
    {
        $this->validate();
        $perm = Permission::massCreate( $this->modelData() );
        $this->modalFormVisible = false;

        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $this->validate();
        Permission::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

        $this->emit('saved');
    }

    public function mount()
    {
        $this->perm_name;
        $this->guard_name;
        $this->button = create_button($this->action??'create', "Wewenang");
    }

    public function render()
    {
        return view('livewire.modal.privilage.permission-modal');
    }
}
