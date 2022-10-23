<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Form\FormRespondent;

use App\Repositories\FormRepository;
use App\Repositories\DocumentRepository;

class DocumentController extends Controller
{
    private $formRepository;
    private $documentRepository;

    public function __construct()
    {
        $this->formRepository         = new FormRepository;
        $this->documentRepository     = new DocumentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Document::class;
        return view('admin.document.document-data', compact('document'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';
        return view("admin.document.document-new", compact('action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = id_dec($id,'doc');
        $action = 'update';
        $modelId = $id;
        return view("admin.document.document-new", compact('modelId', 'action'));
    }

    public function export($id)
    {
        $document = $this->documentRepository->find(id_dec($id,'doc'));
        $pdf = PDF::loadview('admin.export.export-document', compact('document'));
        return $pdf->stream();
        return $pdf->download( $document->title);
    }

    public function exportResponse($respondent_id)
    {
        $respondent = FormRespondent::find(id_dec($respondent_id,'response'));
        $document = $this->documentRepository->findByForm($respondent->form->id);
        $name = $respondent->user?$respondent->user->name : 'anonim';
        $pdf = PDF::loadview('admin.export.export-document', compact('respondent', 'document'));
        return $pdf->stream();
        return $pdf->download( $document->title.'-'.$name );
    }
}
