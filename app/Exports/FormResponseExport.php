<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Form\FormRespondent;

use App\Repositories\FormRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\FormQuestionRepository;
use App\Repositories\FormResponseRepository;
use App\Repositories\FormRespondentRepository;
use App\Repositories\BlobRepository;

class FormResponseExport implements FromView
{
    private $formRepository;
    private $questionRepository;
    private $formQuestionRepository;
    private $formResponseRepository;
    private $blobRepository;

    public function __construct($form_id)
    {
        $this->form = $form_id;

        $this->formRepository           = new FormRepository;
        $this->questionRepository       = new QuestionRepository;
        $this->formQuestionRepository   = new FormQuestionRepository;
        $this->formResponseRepository   = new FormResponseRepository;
        $this->formRespondentRepository = new FormRespondentRepository;
    }

    public function view(): View
    {
        $form = $this->formRepository->find($this->form);
        return view('admin.form.export-response', compact('form'));
    }
}
