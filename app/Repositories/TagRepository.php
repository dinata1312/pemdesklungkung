<?php

namespace App\Repositories;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Tag;
    }

}
