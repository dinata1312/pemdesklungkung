<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Navigasi') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Navigasi</a></div>
        </div>
    </x-slot>
    <div class="row">
        <livewire:navigation.navigation-modal name="navigasi"/>
        <div class="col-9">
            <livewire:table.main name="navigation" :model="$navigation" />
        </div>
        <div class="col-3">
            <livewire:navigation.navigation-preview/>
        </div>
    </div>

</x-app-layout>
