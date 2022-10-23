<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Respon') }}</h1>
        @php($form_slug = id_enc($respondent->form_id,'form'))
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.form.index') }}">Formuir</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.form.respondent', $form_slug) }}">Responden</a></div>
            <div class="breadcrumb-item"><a>Respon</a></div>
        </div>
    </x-slot>
    <div>
        @php($edit = False)
        @include('components.form-response-render', compact('respondent','form_slug','edit'))
    </div>

</x-app-layout>
