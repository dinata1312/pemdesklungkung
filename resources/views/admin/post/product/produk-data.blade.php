<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Produk') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Produk</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:post.product.produk-modal name="produk"/>
        <livewire:table.main name="produk" :model="$produk" />
    </div>
</x-app-layout>
