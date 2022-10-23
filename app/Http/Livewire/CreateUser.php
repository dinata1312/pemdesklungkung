<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $user;
    public $userId;
    public $action;
    public $button;

    public $userRoles = [];
    public $rolesOptions;

    protected function getRules()
    {
        $rules = ($this->action == "updateUser") ? [
            'user.email' => 'required|email|unique:users,email,' . $this->userId
        ] : [
            'user.password' => 'required|min:8|confirmed',
            'user.password_confirmation' => 'required' // livewire need this
        ];

        return array_merge([
            'user.name' => 'required|min:3',
            'user.username' => 'required|alpha_dash|min:7|max:24|unique:users,username,' . $this->userId,
            'user.email' => 'required|email|unique:users,email'
        ], $rules);
    }

    public function createUser ()
    {
        $this->resetErrorBag();
        $this->validate();

        $password = $this->user['password'];

        if ( !empty($password) ) {
            $this->user['password'] = Hash::make($password);
        }

        $user = User::create($this->user);
        foreach ($this->userRoles as $role){
            $user->assignRole($role);
        }
        $this->emit('saved');
        $this->reset('user');
    }

    public function updateUser ()
    {
        $this->resetErrorBag();
        $this->validate();

        User::query()
            ->where('id', $this->userId)
            ->update([
                "name" => $this->user->name,
                "email" => $this->user->email,
            ]);
        $user = User::find($this->userId);
        $user->fresh()->roles;
        foreach ($this->userRoles as $role){
            $user->assignRole($role);
        }
        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->user && $this->userId) {
            $this->user = User::find($this->userId);
            if ($this->action == "updateUser") {
                $this->userRoles = $this->user->getRoleNames()->toArray();
                $this->emit('setSelectedOption', [$this->userRoles, 'userRoles']);
            }
        }

        $this->rolesOptions = eloquent_to_options(Role::get(), 'name', 'name');
        $this->button = create_button($this->action, "User");
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
