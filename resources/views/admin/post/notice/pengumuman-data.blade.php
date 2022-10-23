<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Pengumuman') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Pengumuman</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:post.notice.pengumuman-modal name="pengumuman"/>
        <livewire:table.main name="pengumuman" :model="$pengumuman" />
    </div>
</x-app-layout>
