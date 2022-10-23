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
                <x-jet-label for="label" value="{{ __('Nama Kategori') }}" :required="True"/>
                <x-jet-input id="label" class="w-full mt-1" type="text" wire:model.defer="label" />
                @error('label') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <div class="form-group">
                    <x-jet-label for="term_id" value="{{ __('Rumpun Topik') }}" />
                    <x-select2 model="term_id" :options="$termOptions" :selected="$term" title="" :multiple="False" :allowNull="True"></x-select2>
                    @error('term_id') <span class="error">{{ $message }}</span> @enderror
                </div>
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
