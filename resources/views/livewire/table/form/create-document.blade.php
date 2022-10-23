<div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
    <div class="p-8 pt-4 mt-2 bg-white" x-data="window.__controller.dataTableMainController()" x-init="setCallback();">
        <div class="px-6 py-4">
            <div class="col-span-6 form-group sm:col-span-5">
                <x-jet-label for="title" value="{{ __('Judul Dokumen') }}" />
                <x-jet-input id="title" type="text" class="block w-full mt-1 shadow-none form-control" wire:model.defer="title" />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="row">
                <div class="col">
                    <div class="col-span-6 form-group sm:col-span-5">
                        <x-jet-label for="content" value="{{ __('Sisipkan Penanda') }}" />
                        <div class="mt-2 btn-group">
                            <x-select2 model="marker" :options="$questionOption" :selected="[]" :multiple="False" :allowNull="True"></x-select2>
                            {{-- <input class="form-control" style="height:35px" type="text" placeholder="%penanda pertanyaan%" wire:model.defer="marker"> --}}
                        </div>
                        <button class="mb-10 btn btn-info" href="#" wire:click="setMarker"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-span-6 form-group sm:col-span-5">
                <x-jet-label for="content" value="{{ __('Konten') }}" :required="True"/>
                <x-summernote model="content"></x-summernote>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <form wire:submit.prevent="{{ $action }}">
                @if ($documentId)
                <input type="submit" class="px-4 ml-2 shadow-none btn btn-dark" wire:loading.attr="disabled"
                value="{{ __( strtoupper($button['submit_text']) ) }}">
                @else
                <input type="submit" class="px-4 ml-2 shadow-none btn btn-success" wire:loading.attr="disabled"
                value="{{ __( strtoupper($button['submit_text']) ) }}">
                @endif
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __($button['submit_response']) }}
                </x-jet-action-message>
            </form>
            <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
        </div>
    </div>
</div>
