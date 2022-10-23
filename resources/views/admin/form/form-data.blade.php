<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Formulir') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a>Formuir</a></div>
        </div>
    </x-slot>
    <div>
        <livewire:form.form-modal cname="formulir"/>
        <livewire:table.main name="form" :model="$form" />
    </div>

</x-app-layout>
