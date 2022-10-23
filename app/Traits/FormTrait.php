<?php

namespace App\Traits;

use App\Models\Form\Form;
use App\Repositories\DocumentRepository;

trait FormTrait {

    public $formId;
    public $document;


    public function unbindDocument($id)
    {
        $documentRepository = new DocumentRepository;
        $documentRepository->unbindForm($id);
        $this->refreshTable();
    }

    public function cloneDocument($id)
    {
        $documentRepository = new DocumentRepository;
        $documentRepository->duplicate($id);
        $this->refreshTable();
    }
}
