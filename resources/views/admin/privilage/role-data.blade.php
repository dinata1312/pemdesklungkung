<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Peran') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
        <div class="breadcrumb-item"><a href="#">Hak Akses</a></div>
        <div class="breadcrumb-item"><a>Peran</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:privilage.role-modal name="peran"/>
        <livewire:table.main name="role" :model="$role" />
    </div>
</x-app-layout>
