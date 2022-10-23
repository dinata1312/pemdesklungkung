<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Responden') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.form.index') }}">Formuir</a></div>
            <div class="breadcrumb-item"><a>Responden</a></div>
        </div>
    </x-slot>
    <div>
        <livewire:table.main name="response" :model="$respondent" :formId="$formId" :document="$documentBind"/>
    </div>

</x-app-layout>
