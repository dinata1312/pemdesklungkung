<?php

namespace App\Http\Livewire\Form;

use App\Models\Document;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Repositories\QuestionRepository;

class CreateDocument extends Component
{
    public $documentId;
    public $action;
    public $button;

    public $title;
    public $content;

    public $marker;
    public $questionOption;

    public function modelData()
    {
        return array_merge([
            'title'   => $this->title,
            'content' => $this->content,
        ]);
    }

    protected function getRules()
    {
        return [
            'title'    => 'required',
            'content' => 'required',
        ];
    }

    public function setMarker()
    {
        if( !is_null($this->marker) ) $this->emit('pasteText', ['content',"%".$this->marker."%"]);
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->validate();

        Document::create($this->modelData());

        $this->emit('saved');
        $this->reset(['title','content']);
        return redirect(route('admin.document.index'));
    }

    public function update()
    {
        $this->resetErrorBag();
        $this->validate();

        Document::find($this->documentId)->update($this->modelData());

        $this->emit('saved');
    }

    public function mount ()
    {
        if ($this->documentId) {
            $doc = Document::find($this->documentId);
            $this->title   = $doc->title;
            $this->content = $doc->content;
        }
        $questionRepository = new QuestionRepository;
        $this->questionOption = eloquent_to_options($questionRepository->getWithMarker(), 'marker', 'label');
        $this->button = create_button($this->action, "Dokumen");
    }

    public function render()
    {
        return view('livewire.table.form.create-document');
    }
}
