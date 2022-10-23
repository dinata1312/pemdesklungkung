<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Form\Form;
use App\Models\Form\Question;
use App\Models\Form\FormQuestion;
use App\Models\Form\FormResponse;
use App\Models\Form\FormRespondent;

use App\Repositories\FormRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\FormQuestionRepository;
use App\Repositories\FormResponseRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\BlobRepository;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormResponseExport as ResponseExport;

class DynamicFormController extends Controller
{
    private $formRepository;
    private $questionRepository;
    private $formQuestionRepository;
    private $formResponseRepository;
    private $documentRepository;
    private $blobRepository;

    public function __construct()
    {
        $this->formRepository         = new FormRepository;
        $this->questionRepository     = new QuestionRepository;
        $this->formQuestionRepository = new FormQuestionRepository;
        $this->formResponseRepository = new FormResponseRepository;
        $this->documentRepository     = new DocumentRepository;
        $this->blobRepository         = new BlobRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $form = Form::class;
        return view('admin.form.form-data', compact('form'));
    }

    public function question()
    {
        $question = Question::class;
        return view('admin.form.question-data', compact('question'));
    }

    public function formManage($form_slug)
    {
        $form = Form::where('slug',$form_slug)->first();
        if(!$form){
            $id = id_dec($form_slug,'form');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        return view('admin.form.form-question-data', compact('form'));
    }

    public function formRespondent($form_slug)
    {
        $form = Form::where('slug',$form_slug)->first();
        if(!$form){
            $id = id_dec($form_slug,'form');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        $formId = $form->id;
        $respondent = FormRespondent::class;
        $documentBind = $this->documentRepository->findByForm($formId);
        return view('admin.form.response-data', compact('respondent','formId','documentBind'));
    }

    public function formResponse($form_slug, $respondent_id)
    {
        $form = Form::where('slug',$form_slug)->first();
        $respondent = FormRespondent::find(id_dec($respondent_id,'response'));
        if(!$form){
            $id = id_dec($form_slug,'form');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        return view('admin.form.respondent', compact('respondent'));
    }

    public function exportResponse($form_slug)
    {
        $form = Form::where('slug',$form_slug)->first();
        if(!$form){
            $id = id_dec($form_slug,'form');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        $export = new ResponseExport($form->id);
        // return view('admin.form.export-response', compact('form'));
        return Excel::download($export, $form->name.'- (respon).xlsx');
    }
}
