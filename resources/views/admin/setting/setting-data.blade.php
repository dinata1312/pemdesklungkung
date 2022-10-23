<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Pengaturan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.setting.general') }}">Pengaturan</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:table.setting name="setting" :model="$setting" />
    </div>
</x-app-layout>
