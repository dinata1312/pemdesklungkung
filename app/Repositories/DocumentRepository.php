<?php

namespace App\Repositories;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DocumentRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Document;
    }

    public function create(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        return $this->model::create($data);
    }

    public function findByForm($formId)
    {
        return $this->model::where('form_id',$formId)->first();
    }

    public function getWithNoForm()
    {
        return $this->model::whereNull('form_id')->get();
    }

    public function unbindForm($id)
    {
        $document = $this->model::find($id);
        return $document->update(['form_id'=> null]);
    }

    public function duplicate($id)
    {
        $data = $this->model::find($id)->toArray();
        $remove = ['id','created_by','form_id','created_at'];
        $data['title'] .=" -salinan";
        foreach($remove as $item){
            unset($data[$item]);
        }
        return $this->model::create($data);
    }
}
