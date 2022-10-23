<div>
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            @if (is_null($modelId))
            {{ __(ucwords("Buat ".$name)) }}
            @else
            {{ __(ucwords("Edit ".$name)) }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="label" value="{{ __('Label Pertanyaan') }}" :required="True"/>
                <x-jet-input id="label" class="w-full mt-1 in-title" type="text" wire:model.defer="label" />
                @error('label') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col">
                        <x-jet-label for="type" value="{{ __('Jenis') }}" :required="True"/>
                        <select wire:model.debounce.500ms="type" id="type" class="w-full mt-1 rounded-md shadow-sm form-input in-title">
                            <option disabled>Pilih jenis isian</option>
                            <option value="text"> Teks</option>
                            <option value="long-text"> Teks Panjang</option>
                            <option value="number"> Angka</option>
                            <option value="date"> Tanggal</option>
                            <option value="radio"> Opsi</option>
                            <option value="select-one"> Pilihan Ganda</option>
                            <option value="select-multiple"> Pilihan Ganda Multi</option>
                            <option value="email"> Email</option>
                            <option value="file-upload"> Dokumen</option>
                        </select>
                        @error('type') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col">
                        <x-jet-label for="placeholder" value="{{ __('Placeholder') }}" />
                        <x-jet-input id="placeholder" class="w-full mt-1 in-title" type="text" wire:model.defer="placeholder" />
                        @error('placeholder') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            @if($this->withOption($type))
            <div class="mt-4">
                <x-jet-label for="meta" value="{{ __('Nilai Opsi') }}" />
                @foreach ($this->inputFields as $key => $item)
                <div class="row">
                    <div class="col-10">
                        <input class="w-full mt-1 rounded-md shadow-sm form-input" type="text" wire:model.defer="meta.{{ $item }}">
                    </div>
                    <div class="mt-1 col-2">
                        @if($key == 0)
                        <a wire:click.prevent="addField({{ $this->inputAmount }})" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        @else
                            <a wire:click.prevent="removeField({{ $key }})" class="btn btn-danger"><i class="fa fa-times"></i></a>
                        @endif
                    </div>
                </div>
                @endforeach
                @error('meta.*') <span class="error">{{ $message }}</span> @enderror
            </div>
            @endif
            <div class="mt-4 form-group">
                <x-jet-label for="required" value="Wajib Diisi" />
                <label class="mt-2">
                  <span class="custom-switch-description">Tidak</span>
                  <input id="required" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" wire:model.defer="required">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Ya</span>
                </label>
            </div>
            <div class="mt-4">
                <a data-toggle="collapse" href="#collapseAdvance" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Pengaturan lanjutan
                </a>
            </div>
            <div class="collapse" id="collapseAdvance">
                <hr>
                <x-jet-label for="marker" value="{{ __('Penanda') }}" />
                <small>Hanya digunakan saat membuat formulir sambungan</small>
                <x-jet-input id="marker" class="w-full mt-1 in-title" type="text" wire:model.defer="marker" />
                @error('marker') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <form wire:submit.prevent="{{ $action }}">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')">
                {{ __('Tutup') }}
            </x-jet-secondary-button>
            @if ($modelId)
            <input type="submit" class="px-4 ml-2 shadow-none btn btn-dark" wire:loading.attr="disabled"
                value="{{ __( strtoupper($button['submit_text']) ) }}">
            @else
            <input type="submit" class="px-4 ml-2 shadow-none btn btn-success" wire:loading.attr="disabled"
                value="{{ __( strtoupper($button['submit_text']) ) }}">
            @endif
            </form>
        </x-slot>
    </x-jet-dialog-modal>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
