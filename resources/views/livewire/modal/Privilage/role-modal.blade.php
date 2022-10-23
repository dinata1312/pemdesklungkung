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
                <x-jet-label for="name" value="{{ __('Nama Peran') }}" :required="True"/>
                <x-jet-input id="name" class="w-full mt-1" type="text" wire:model.defer="role_name"/>
                @error('role_name') <span class="error">{{ $message }}</span> @enderror
            </div>
            @if (!is_null($modelId))
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Wewenang') }}" />
                <livewire:privilage.permission-select name="permission" :model="$permissionModal" :modify="True"/>
            </div>
            @endif
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
