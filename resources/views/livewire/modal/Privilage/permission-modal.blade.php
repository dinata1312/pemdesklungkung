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
            @if (is_null($modelId))
            <div class="mt-4">
                <div class="row">
                    <div class="col-10">
                        <x-jet-label for="name" value="{{ __('Nama Wewenang') }}" :required="True"/>
                    </div>
                </div>
                @foreach ($this->inputFields as $key => $item)
                <div class="row">
                    <div class="col-10">
                        <input class="w-full mt-1 rounded-md shadow-sm form-input" type="text" wire:model.defer="perm_name.{{ $item }}">
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
                @error('perm_name.*') <span class="error">{{ $message }}</span> @enderror
            </div>
            @else
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Nama Wewenang') }}" />
                <x-jet-input id="name" class="w-full mt-1" type="text" wire:model.defer="perm_name" />
                @error('perm_name') <span class="error">{{ $message }}</span> @enderror
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
