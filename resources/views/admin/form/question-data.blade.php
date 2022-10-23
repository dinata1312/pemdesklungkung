<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Pertanyaan') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.form.index') }}">Formuir</a></div>
            <div class="breadcrumb-item"><a>Pertanyaan</a></div>
        </div>
    </x-slot>
    <div>
        <livewire:form.question-modal name="Pertanyaan"/>
        <livewire:table.main name="question" :model="$question" />
    </div>

</x-app-layout>
