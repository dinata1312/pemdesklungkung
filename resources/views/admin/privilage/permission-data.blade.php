<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Wewenang') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="#">Hak Akses</a></div>
            <div class="breadcrumb-item"><a>Wewenang</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:privilage.permission-modal name="wewenang"/>
        <livewire:privilage.permission-select name="permission" :model="$permission"/>
    </div>
</x-app-layout>
