<?php

namespace App\Traits;

use App\Models\Post;

trait PostTrait {

    public $publish = [0,1];

    public function publishState($state)
    {
        switch ($state) {
            case "semua":
                $value = [0,1];
                break;
            case "terbit":
                $value = [1];
                break;
            case "konsep":
                $value = [0];
                break;
            default:
                $value = [0,1];
                break;
        }
        $this->publish = $value;
    }

}
