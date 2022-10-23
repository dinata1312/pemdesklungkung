<div>
    <x-jet-dialog-modal wire:model="modalFormVisible" maxWidth="4xl">
        <x-slot name="title">
            @if (is_null($modelId))
            {{ __(ucwords("Buat ".$name)) }}
            @else
            {{ __(ucwords("Edit ".$name)) }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Judul') }}" :required="True"/>
                <x-jet-input id="title" class="w-full mt-1 in-title" type="text" wire:model.defer="title" />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">{{ route('notice.index')."/" }}</span>
                    </div>
                    <input id="slug" type="text" class="form-control in-link" placeholder="tautan" wire:model.defer="slug">
                </div>
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Konten') }}" :required="True"/>
                <x-summernote model="content"></x-summernote>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <div class="form-group">
                    <x-jet-label for="tag" value="{{ __('Tag') }}" />
                    <x-select2 model="postTags" :options="$postOptionTags" :selected="$postTags" :tags="True"></x-select2>
                    @error('tag') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <x-jet-label for="publish" value="Terbitkan {{ __($name) }}" />
                <label class="mt-2">
                  <span class="custom-switch-description">Konsep</span>
                  <input id="publish" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" wire:model.defer="publish">
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Terbitkan</span>
                </label>
            </div>

            <div class="mt-4">
                <div class="form-group">
                    <x-jet-label for="images" value="{{ __('Gambar') }}" />
                </div>
            </div>
            <livewire:blob.file-upload active="document" attribute="image" size="small" :selected="[]" directory="gambar" :directoryOption="['gambar']"/>

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
