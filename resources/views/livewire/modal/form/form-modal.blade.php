<div>
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            @if (is_null($modelId))
            {{ __(ucwords("Buat ".$cname)) }}
            @else
                @if ($this->action=="preview")
                {{ __(ucwords("Pratinjau")) }}
                @elseif ($this->action=="connect")
                {{ __(ucwords("Hubungkan Dokumen")) }}
                @else
                {{ __(ucwords("Edit ".$cname)) }}
                @endif
            @endif
        </x-slot>

        <x-slot name="content">
            @if (!is_null($modelId) && $this->action=="preview")
            <iframe src="{{ route('form.public',id_enc($modelId,'form-public')) }}" width="100%" height="500px" title="Formulir Publik"></iframe>
            @elseif (!is_null($modelId) && $this->action=="connect")
            <x-jet-label for="document" value="{{ __('Nama Dokumen') }}" :required="True"/>
            <x-select2 model="document" :options="$documentOption" :selected="$documentTags" :multiple="False" :alt="True"></x-select2>
            @else
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nama Formulir') }}" :required="True"/>
                <x-jet-input id="name" class="w-full mt-1 in-title" type="text" wire:model.defer="name" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="desc" value="{{ __('Deskripsi') }}" :required="True"/>
                <x-summernote model="desc"></x-summernote>
                @error('desc') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <x-jet-label for="closed" value="Status Formulir" />
                <label class="mt-2">
                  <span class="custom-switch-description">Dibuka</span>
                  <input id="closed" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" wire:model.defer="closed">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Ditutup</span>
                </label>
            </div>

            <div class="mt-4">
                <a wire:click="$set('colapse', !$collapse)" data-toggle="collapse" href="#collapseAdvance" role="button" aria-expanded="true" aria-controls="collapseExample">
                    Pengaturan lanjutan
                </a>
            </div>
            <div class="collapse show" id="collapseAdvance">
                <hr>
                <x-jet-label for="open_time" value="{{ __('Tautan Alternatif') }}"/>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">{{ route('notice.index')."/form/" }}</span>
                    </div>
                    <input id="slug" type="text" class="form-control" placeholder="tautan" wire:model.defer="slug">
                </div>
                @error('slug') <span class="error">{{ $message }}</span> @enderror
                <div class="mt-4">
                    <x-jet-label for="open_time" value="{{ __('Tanggal Dibuka') }}"/>
                    <x-date model="open_time" type="datetime-local"></x-date>
                    <span class="cursor-pointer" wire:click="$set('open_time', null)">Kosongkan</span>
                    @error('open_time') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="close_time" value="{{ __('Tanggal Ditutup') }}"/>
                    <x-date model="close_time" type="datetime-local"></x-date>
                    <span class="cursor-pointer" wire:click="$set('close_time', null)">Kosongkan</span>
                    @error('close_time') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <form wire:submit.prevent="{{ $action }}">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')">
                    {{ __('Tutup') }}
                </x-jet-secondary-button>
            @if (in_array($this->action,['update','create']))
                @if ($modelId)
                <input type="submit" class="px-4 ml-2 shadow-none btn btn-dark" wire:loading.attr="disabled"
                    value="{{ __( strtoupper($button['submit_text']) ) }}">
                @else
                <input type="submit" class="px-4 ml-2 shadow-none btn btn-success" wire:loading.attr="disabled"
                    value="{{ __( strtoupper($button['submit_text']) ) }}">
                @endif
            @elseif ($this->action == 'connect')
            <input type="submit" class="px-4 ml-2 shadow-none btn btn-success" wire:loading.attr="disabled"
                value="{{ __( strtoupper($button['submit_text']) ) }}">
            @endif
            </form>
        </x-slot>
    </x-jet-dialog-modal>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
