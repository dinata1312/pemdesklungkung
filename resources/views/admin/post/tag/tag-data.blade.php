<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Penanda') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Penanda</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:post.tag.tag-modal name="kategori"/>
        <livewire:post.tag.term-modal name="topik"/>
        <div class="row">
            <div class="col-8">
                <livewire:table.main name="tag" :model="$tag" />
            </div>
            <div class="col-4">
                <livewire:table.main name="term" :model="$term" />
            </div>
        </div>
    </div>
</x-app-layout>
