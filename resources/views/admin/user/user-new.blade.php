<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Buat User Baru') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.user') }}">User</a></div>
            <div class="breadcrumb-item"><a>Buat User Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:create-user action="createUser" />
    </div>
</x-app-layout>
