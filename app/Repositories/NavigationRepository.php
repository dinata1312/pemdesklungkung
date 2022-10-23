<?php

namespace App\Repositories;

use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NavigationRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Navigation;
    }

    public function lastSequence()
    {
        $last = Navigation::orderBy('sequence', 'desc')->first();
        if($last){
            return $last->sequence;
        }else{
            return 0;
        }
    }

    public function getBySequence($seq)
    {
        return Navigation::where('sequence',$seq)->first();
    }

    public function swapSequence($swap_id, $direction)
    {
        $cur = Navigation::find($swap_id);
        $curSeq = $cur->sequence;

        switch ($direction){
            case 'up':
                $target = $this->getBySequence($curSeq-1);#up
                break;
            case 'down':
                $target = $this->getBySequence($curSeq+1);#down
                break;
        }
        if($target){
            $cur->update(['sequence'=>$target->sequence]);
            $target->update(['sequence'=>$curSeq]);
            return true;
        }
        return false;
    }

    public function parentId($id)
    {
        return $this->model->find($id)->child_of;
    }
}
