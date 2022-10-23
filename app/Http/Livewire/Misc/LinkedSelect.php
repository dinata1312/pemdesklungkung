<?php

namespace App\Http\Livewire\Misc;

use Livewire\Component;

class LinkedSelect extends Component
{
    protected $listeners = [
        'catchSignal' => 'catchSignal',
        ];

    public $appModel;   # Model
    public $model;      # Property that treated as field name
    public $column;     # Column that will be shown as option
    public $signal;     # Signal key
    public $catch;      # Listen signal key
    public $as;         # Column of signal find as

    public function render()
    {
        return view('livewire.misc.linked-select');
    }
}
