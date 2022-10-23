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
                <x-jet-label for="title" value="{{ __('Label') }}" :required="True"/>
                <x-jet-input id="label" class="w-full mt-1" type="text" wire:model.defer="label" />
                @error('label') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="link" value="{{ __('Tautan') }}" :required="True"/>
                <x-jet-input id="link" class="w-full mt-1" type="text" wire:model.defer="link" />
                @error('link') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <div class="form-group">
                    <x-jet-label for="tag" value="{{ __('Sub Label Dari') }}" />
                    <x-select2 model="child_of" :options="$navigationOptionParents" :selected="$navigationParent" title="" :multiple="False" :allowNull="True"></x-select2>
                    @error('child_of') <span class="error">{{ $message }}</span> @enderror
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
