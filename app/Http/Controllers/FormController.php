<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Form\Form;

use App\Repositories\FormRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\FormQuestionRepository;
use App\Repositories\FormResponseRepository;
use App\Repositories\FormRespondentRepository;
use App\Repositories\BlobRepository;

class FormController extends Controller
{
    private $formRepository;
    private $questionRepository;
    private $formQuestionRepository;
    private $formResponseRepository;
    private $formRespondentRepository;
    private $blobRepository;

    public function __construct()
    {
        $this->formRepository           = new FormRepository;
        $this->questionRepository       = new QuestionRepository;
        $this->formQuestionRepository   = new FormQuestionRepository;
        $this->formResponseRepository   = new FormResponseRepository;
        $this->formRespondentRepository = new FormRespondentRepository;
        $this->blobRepository           = new BlobRepository;
    }

    public function public($form_slug)
    {
        $form = Form::where('slug',$form_slug)->first();
        if(!$form){
            $id = id_dec($form_slug,'form-public');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        $questions = $this->formRepository->questions($form->id);
        return view('public.form.index', compact('form','questions','form_slug'));
    }

    public function postResponse(Request $request, $form_slug)
    {
        $form = Form::where('slug',$form_slug)->first();
        if(!$form){
            $id = id_dec($form_slug,'form-public');
            $form = Form::find($id);
            if(!$form) abort(404, 'Page not found');
        }
        $input = $request->all();
        $respondent = $this->formRespondentRepository->create([
                        'user_id' => Auth::check() ? Auth::user()->id : null,
                        'form_id' => $form->id,
                    ]);
        foreach ($input as $key => $val){
            if($key !== '_token' and $key !== 'submit'){
                $form_question_id = id_dec($key, 'respon');
                $form_question = $this->formQuestionRepository->findId($form_question_id);
                if(is_array($val)){
                    $val = json_encode($val);
                }
                if($form_question->type === 'file-upload'){
                    $path = $this->blobRepository->uploadFile($request->file($key), "attachment", 1, True);
                    $data = [
                        'respondent_id' => $respondent->id,
                        'form_question_id' => $form_question_id,
                        'value' => $path,
                        ];
                }else{
                    $data = [
                        'respondent_id' => $respondent->id,
                        'form_question_id' => $form_question_id,
                        'value' => $val,
                        ];
                }
                $respons = $this->formResponseRepository->store($data);
            }
        }
        return redirect("form/". $form_slug);
    }

}
