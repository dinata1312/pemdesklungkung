<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Formulir '.ucwords(strtolower($form->name))) }}</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.form.index') }}">Formuir</a></div>
            <div class="breadcrumb-item"><a>Detail</a></div>
        </div>
    </x-slot>
    <div>
        {{-- Modal Question --}}
        <livewire:form.question-modal name="Pertanyaan"/>
        {{-- Render Question --}}
        <livewire:form.form-question-manage :model="$form"/>
    </div>

</x-app-layout>
