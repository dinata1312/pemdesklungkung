
@extends('layouts.frontend')
@section('title', "Formulir ".$form->name)

@section('content')
<section class="content d-flex align-items-center">
    <div class="container">
        @include('components.form-render',['questions' => $questions, 'formSlug' => id_enc($form->id,'form-public')])
    </div>
</section>
@endsection
