<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Kelola Berkas') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="#">Kelola Berkas</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:blob.file-upload active="document" perPage="12"/>
    </div>
</x-app-layout>
