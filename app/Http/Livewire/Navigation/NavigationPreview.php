<?php

namespace App\Http\Livewire\Navigation;

use Livewire\Component;
use App\Repositories\NavigationRepository;

class NavigationPreview extends Component
{

    protected $listeners = [
        "deleteItem" => "refreshTable",
        "saved"      => "refreshTable"
    ];

    public function mount ()
    {
        //
    }

    public function refreshTable()
    {
        $this->render();
        $this->reset();
    }

    public function render()
    {
        $navigationRepository = new NavigationRepository;
        $navigations = $navigationRepository->all()->sortBy("sequence");
        return view('livewire.misc.navigation-sidebar', compact('navigations'));
    }
}
