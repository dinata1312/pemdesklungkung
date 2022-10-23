<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Baner') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Baner</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:post.hero.banner-modal name="banner"/>
        <livewire:table.main name="banner" :model="$banner" />
    </div>
</x-app-layout>
