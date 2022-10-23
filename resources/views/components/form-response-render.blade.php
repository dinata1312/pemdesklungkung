
<div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        <div class="flex pb-4 -ml-3">
            <a href="{{ route('admin.form.respondent', $form_slug) }}" class="shadow-none -ml- btn btn-light">
                <span class="fas fa-chevron-left"></span> Kembali
            </a>
        </div>

        <div>
            @php
                $user     = $respondent->user;
                $form     = $respondent->form;
                $response = $respondent->formResponses;
            @endphp
            @forelse ($form->formQuestions as $item)
                @php
                    $options = [];
                    $meta = json_decode($item->question->meta,true);
                    if(!is_null($meta)){
                        if ( array_key_exists('option', $meta) ) {
                            $options = $meta['option'];
                        }
                    }
                    $value = collection_match($response, 'form_question_id', $item->id, 'value');
                @endphp
            <div class="row form-response">
                <div class="col-12 form-group">
                    <label for="field-{{ $loop->iteration }}">{{ $item->question->label }}</label> @if ($item->question->required ?? False) @include('components.required') @endif
                @if (in_array($item->question->type,['radio','number','date','text-long','select-one','select-multiple','file-upload']))
                    <span class="mb-2 text-gray-500 d-block">{{ $item->question->placeholder }}</span>
                @endif
                @if (in_array($item->question->type,['text','number','date','email']))
                    <input name="{{ id_enc($item->question->id, 'respon') }}"  type="{{ $item->question->type }}" class="form-control" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
                        placeholder="{{ $item->question->placeholder }}" {{ $edit ? '':'disabled' }}
                        value = "{{ $value }}">
                @elseif ($item->question->type=='long-text')
                    <textarea name="{{ id_enc($item->question->id, 'respon') }}" class="form-control" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
                        rows="10" {{ $edit ? '':'disabled' }}>{{ $value }}</textarea>
                @elseif ($item->question->type=='radio')
                <div class="form-group">
                    @forelse ($options as $option)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input name="{{ id_enc($item->question->id, 'respon') }}" type="radio" id="radio{{ $loop->iteration }}" value="{{ $option }}" {{ $item->question->required ? 'required' : '' }}
                            class="custom-control-input" {{ $edit ? '':'disabled' }}
                            {{ $option == $value ? 'checked':'' }}>
                        <label class="custom-control-label"
                            for="radio{{ $loop->iteration }}">{{ $option }}</label>
                    </div>
                    @empty
                        <i>Tidak ada opsi</i>
                    @endforelse
                </div>
                @elseif (in_array($item->question->type,['select-one','select-multiple']))
                @php
                    $multi = null;
                    $multi = explode('-',$item->question->type)[1];
                    $values = json_decode($value,true);
                @endphp
                <select name="{{ id_enc($item->question->id, 'respon') }}{{ $multi=="multiple" ? '[]':'' }}" class="custom-select form-select" id="field-{{ $loop->iteration }}" {{ $item->question->required ? 'required' : '' }}
                    {{ $multi=="multiple" ? 'multiple':'' }} {{ $edit ? '':'disabled' }}>
                    <option disabled>Pilih {{ $multi=="multiple" ? 'lebih dari satu':'salah satu' }}</option>
                    @foreach ($options as $option)
                        <option value="{{ $option }}"
                            @if ($multi!="multiple")
                            {{ $option == $value ? 'selected':'' }}
                            @else
                                @if (!is_null($values))
                                {{ in_array($option,$values) ? 'selected':'' }}
                                @endif
                            @endif
                        >{{ $option }}</option>
                    @endforeach
                </select>
                {!! $multi=="multiple" ? '<small>Gunakan ctrl untuk memilih lebih dari satu</small>':'' !!}
                @elseif ($item->question->type=='file-upload')
                <input name="{{ id_enc($item->question->id, 'respon') }}" type="file" class="form-control"
                {{ $item->question->required ? 'required' : '' }} {{ $edit ? '':'disabled' }}>
                    @if (!is_null($value))
                        <a class="image-pop text-decoration-none" href="{{ asset("/storage/$value") }}" target="_blank" title="{{ $value }}">
                            <i class="fas fa-search-plus text-info" ></i> Pratinjau</a>
                        <a class="text-decoration-none" href="{{ asset("/storage/$value") }}" target="_blank" title="{{ $value }}">
                            <i class="fas fa-arrow-circle-down text-success"></i> Unduh</a>
                    @else
                        Tidak ada Dokumen
                    @endif

                @endif
                </div>
            </div>
            @empty
                Belum Ada Pertanyaan
            @endforelse
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        $('.image-pop').magnificPopup({type:'image',image: {
                titleSrc: 'title'
            }});
    });
</script>

