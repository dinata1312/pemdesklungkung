<x-app-layout>
    <x-slot name="header_content">
        <h1>@if (is_null($modelId ?? null))
                {{ __(ucwords("Buat Dokumen")) }}
                @else
                {{ __(ucwords("Edit Dokumen")) }}
            @endif</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.document.index') }}">Dokumen</a></div>
            <div class="breadcrumb-item"><a href="#">Buat Dokumen Baru</a></div>
        </div>
    </x-slot>

    <div>
        <livewire:form.create-document action="{{ $action }}" :documentId="$modelId ?? null"/>
    </div>
</x-app-layout>
