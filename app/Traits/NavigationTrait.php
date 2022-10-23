<?php

namespace App\Traits;

use App\Repositories\NavigationRepository;

trait NavigationTrait {

    public function setSequence($id, $direction)
    {
        $navigationRepository = new NavigationRepository;
        $navigationRepository->swapSequence($id,$direction);
        $this->emit('saved');
    }

}
