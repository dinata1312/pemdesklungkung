
@extends('layouts.frontend')
@section('title', $post->title." - Halaman")

@section('content')
<section id="blog" class="blog content">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 entries">
                <article class="entry entry-single">
                    <h1 class="mb-4 text-center page-title">{{ $post->title??'Judul' }}</h1>
                    <div class="entry-img">
                        <div class="owl-carousel owl-theme slider" id="slider1">
                            @foreach ($post->postImages as $pImage)
                            <div><img alt="{{ $pImage->image->filename }}" src="{{ asset('storage/'.$pImage->image->path) }}"></div>
                            @endforeach
                        </div>
                    </div>
                    {!! $post->content !!}
                    <div class="d-block">
                        <hr>
                        <p>Penulis: <small>{!! $post->creator ? $post->creator->name : '<i>Anonim</i>' !!}</small>
                        @if(!is_null($post->publisher))
                        <br>Penerbit: <small>{{ $post->publisher->name }}</small>
                        @endif
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
