<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Bagian') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.setting.general') }}">Pengaturan</a></div>
            <div class="breadcrumb-item"><a>Bagian</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.setting name="section" :model="$section" />
    </div>
</x-app-layout>
