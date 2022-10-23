<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Halaman') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Halaman</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:post.page.halaman-modal name="halaman"/>
        <livewire:table.main name="halaman" :model="$halaman" />
    </div>
</x-app-layout>
