<div class="row">
    <div class="col-12">
        <div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
            <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();" style="min-height:900px">
                <div class="flex pb-4 -ml-3">
                    <div class="btn-group" role="group" aria-label="group">
                        @php
                            $settingHead = [
                                ['href' => 'admin.setting.general',
                                 'name' => 'Umum'
                                ],
                                ['href' => 'admin.setting.section',
                                 'name' => 'Bagian'
                                ],
                            ];
                        @endphp
                    @foreach ($settingHead as $item)
                        <a href="{{ route($item['href']) }}" type="button" class="btn btn-primary
                            {{ Request::routeIs($item['href']) ? 'disabled' : '' }}">{{ $item['name'] }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    @foreach ($options as $option)
                    <div class="col-6">
                        @if (value_of_key($option, 'title'))
                            <input type="text" class="form-control"
                                wire:model.defer="title.{{ $option->key }}">
                        @else
                            <h3 for="option-{{ id_enc($option->id) }}">{{ $option->key }}</h3>
                        @endif
                        @if ($option->type == 'long-text')
                            <x-summernote model="option.{{ $option->key }}"></x-summernote>
                            @error('option.{{ $option->key }}') <span class="error">{{ $message }}</span> @enderror
                        @elseif ($option->type == 'text')
                            <input class="form-control" id="option-{{ id_enc($option->id) }}"
                                type="text" wire:model.defer="option.{{ $option->key }}">
                        @elseif ($option->type == 'boolean')
                        <label class="mt-2 custom-switch">
                            <span class="custom-switch-description">Tidak Aktif</span>
                            <input type="checkbox" name="{{ id_enc($option->id) }}-switch-checkbox" class="custom-switch-input"
                                wire:model.defer="option.{{ $option->key }}">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Aktif</span>
                        </label>
                        @endif
                        @if ( !is_null($option->meta) )
                            <div class="mb-5">
                                <h3>Gambar Untuk {!! $this->title[$option->key] !!}</h3>
                                <div class="col form-inline">
                                    <input  wire:model.defer="meta.{{ $option->key }}" type="file" class="form-control">
                                    <input  wire:model.defer="meta.{{ $option->key }}" type="text" class="form-control">
                                    @if ( !is_null($option->meta) )
                                        <a class="image-pop" href="{{ asset($option->meta) }}" target="_blank" title="{{ $name }}">
                                            <i class="fas fa-search-plus text-info" ></i> Tinjau</a>
                                    @endif
                                </div>
                                @error('option.{{ $option->key }}') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if (perm('admin.setting.update'))
    <div class="col-12 static-bottom">
        <div class="row">
            <div class="d-float col">
                <form wire:submit.prevent="{{ $action }}">
                    <input type="submit" class="float-right px-4 ml-2 shadow-none btn btn-success" wire:loading.attr="disabled"
                    value="{!! __( strtoupper($button['submit_text']) ) !!}">
                </form>
                <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
            </div>
        </div>
    </div>
    @endif
</div>
