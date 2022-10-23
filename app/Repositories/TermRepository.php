<?php

namespace App\Repositories;

use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TermRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Term;
    }

}
