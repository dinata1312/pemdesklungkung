<div>
    <div class="row">
        <div class="col col-sm-8">
            <div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
                <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
                    <div class="flex pb-4 -ml-3">
                        <div class="card-body" style="min-height:200px">

                            <div class="mb-4 section-body">
                                <h2 class="mt-0 section-title">Kelola Pertanyaan</h2>
                                <p class="section-lead">
                                    Perubahan tersimpan secara otomatis <span class="fa fa-check"></span></p>
                            </div>

                            @forelse ($questions as $item)
                                @php
                                    $options = [];
                                    $meta = json_decode($item->question->meta,true);
                                    if(!is_null($meta)){
                                        if ( array_key_exists('option', $meta) ) {
                                            $options = $meta['option'];
                                        }
                                    }
                                @endphp
                                <div class="row">
                                    <div style="width:65px">
                                        <a class="cursor-pointer btn btn-sm btn-light" style="width:30px"
                                            wire:click="swapQuestion('up','{{ id_enc($item->id,'q') }}')">
                                            <i class="fa fa-sort-up"></i></a>
                                        <a class="cursor-pointer btn btn-sm btn-primary" style="width:30px"
                                            wire:click="$emit('showUpdateModal',{{ $item->question->id }})">
                                            <i class="fa fa-pen"></i></a>
                                        <a class="cursor-pointer btn btn-sm btn-light" style="width:30px"
                                            wire:click="swapQuestion('down','{{ id_enc($item->id,'q') }}')">
                                            <i class="fa fa-sort-down"></i></a>
                                        <a class="cursor-pointer btn btn-sm btn-danger" style="width:30px"
                                            wire:click="rmQuestion('{{ id_enc($item->id,'q') }}')">
                                            <i class="fa fa-times"></i></a>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="field-{{ $loop->iteration }}">{{ $item->question->label }}</label> @if ($item->question->required ?? False) @include('components.required') @endif
                                        @if (in_array($item->question->type,['radio','number','date','text-long','select-one','select-multiple','file-upload']))
                                            <span class="mb-2 text-gray-500 d-block">{{ $item->question->placeholder }}</span>
                                        @endif
                                        @if (in_array($item->question->type,['text','number','date','email']))
                                            <input type="{{ $item->question->type }}" class="form-control" id="field-{{ $loop->iteration }}"
                                                placeholder="{{ $item->question->placeholder }}">
                                        @elseif ($item->question->type=='long-text')
                                            <textarea class="form-control" id="field-{{ $loop->iteration }}"
                                                rows="10"></textarea>
                                        @elseif ($item->question->type=='radio')
                                        <div class="form-group">
                                            @forelse ($options as $option)
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="radio{{ $loop->iteration }}" name="{{ id_enc($item->question->id) }}" class="custom-control-input">
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
                                        @endphp
                                        <select class="custom-select" id="field-{{ $loop->iteration }}" {{ $multi=="multiple" ? 'multiple':'' }}>
                                            <option disabled>Pilih {{ $multi=="multiple" ? 'lebih dari satu':'salah satu' }}</option>
                                            @foreach ($options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                        {!! $multi=="multiple" ? '<small>Gunakan ctrl untuk memilih lebih dari satu</small>':'' !!}
                                        @elseif ($item->question->type=='file-upload')
                                        <input type="file" class="form-control">
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                Belum Ada Pertanyaan
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 sticky-top sidebar">
            <div class="row align-items-center">
                <div class="col">
                    {{-- <button class="mr-2 btn btn-success" title="Simpan">
                        <i class="fa fa-save"></i></button> --}}
                    <a class="mr-2 btn btn-primary" title="Responden"
                         href="{{ route('admin.form.respondent',$model->slug??id_enc($model->id,'form')) }}">
                        <i class="fas fa-user-edit"></i></a>
                    <a class="mr-2 btn btn-info" title="Kunjungi Formulir"
                        href="{{ route('form.public',$model->slug??id_enc($model->id,'form-public')) }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i></a>
                    <button class="mr-2 btn btn-dark" title="Salin Tautan" onclick="copyLink('formURL')">
                        <i class="fas fa-link"></i></button>
                    <input value="{{ route('form.public',$model->slug??id_enc($model->id,'form-public')) }}" id="link-formURL" style="display:none">
                </div>
            </div>
            <div class="mt-2 row">
                <div class="col">
                    <div class="btn-group">
                        <button class="btn btn-success" wire:click="$emit('showCreateModal')"><i class="fa fa-plus"></i> Tambah Baru</button>
                        <button id="addExist" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="addExist">
                            <a class="cursor-pointer dropdown-item" wire:click="$toggle('reuse')">Sisipkan pertanyaan lampau</a>
                        </div>
                    </div>
                    @if ($reuse == True)
                    <div class="mt-2 btn-group">
                        <input class="form-control" style="height:35px" type="text" placeholder="%penanda pertanyaan%" wire:model.defer="existing">
                        <button class="btn btn-info" href="#" wire:click="$emit('addExisting')"><i class="fa fa-plus"></i></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
