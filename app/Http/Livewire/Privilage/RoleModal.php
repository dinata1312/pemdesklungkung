<?php

namespace App\Http\Livewire\Privilage;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\Permission;

class RoleModal extends Component
{
    public $model;
    public $name;

    public $modelId;
    public $button;
    public $action;
    public $modalFormVisible = false;

    // Model Attribute
    public $role_name;
    public $guard_name;

    public $permission;
    public $permissionModal;

    protected $listeners = [
        "showCreateModal" => "showCreateModal",
        "showUpdateModal" => "showUpdateModal",
        "selectPermission" => "setPermission"
    ];

    public function setPermission($value)
    {
        if(!is_null($value))
            $this->permission = $value;
    }

    public function modelData()
    {
        $attributes = ($this->action == 'update') ?
        [
        ]: [
        ];

        return array_merge([
            'name' => $this->role_name,
            'guard_name' => $this->guard_name??'web',
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
        $this->button = create_button($this->action, "Peran");
        switch ($this->action){
            case "create":
                $this->reset(['role_name','guard_name']);
                break;
            case "update":
                $role = Role::find($this->modelId);
                $rolePermissions = eloquent_to_selected($role->permissions);
                $this->role_name  = $role->name;
                $this->guard_name = $role->guard_name;
                $this->permission = flip_selected_key($rolePermissions);
                $this->emit('clearSelected');
                $this->emit('setSelectedPerm', $rolePermissions);
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
            'role_name'   => ['required', Rule::unique('roles', 'name')->ignore($this->modelId)],
            'guard_name'  => 'nullable'
        ];
    }

    public function create()
    {
        $this->validate();
        $role = Role::create( $this->modelData() );
        $this->modalFormVisible = false;

        $this->emit('saved');
        $this->loadModalContent();
    }

    public function update()
    {
        $this->validate();
        $role = Role::find($this->modelId);
        $role->update($this->modelData());
        $this->modalFormVisible = false;
        if( count($this->permission)>0 ){
            $perms = filter_checkbox_value($this->permission);
            $clear = $role->revokePermissionTo(Permission::get());
            $role->givePermissionTo($perms);
        }

        $this->emit('saved');
    }

    public function mount()
    {
        $this->role_name;
        $this->guard_name;
        $this->button = create_button($this->action??'create', "Peran");
        $this->permissionModal = Permission::class;
    }

    public function render()
    {
        return view('livewire.modal.privilage.role-modal');
    }
}
