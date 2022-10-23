
@extends('layouts.frontend')
@section('title', $post->title." - Berita")

@section('content')
    <section class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('landing') }}">Beranda</a></li>
            <li><a href="{{ route('notice.index') }}">Pengumuman</a></li>
            <li>{{ $post->title }}</li>
          </ol>
          <h2>Berita</h2>
        </div>
    </section>

      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single">
                    <div class="entry-img">
                        <div class="owl-carousel owl-theme slider" id="slider1">
                            @foreach ($post->postImages as $pImage)
                            <div><img alt="{{ $pImage->image->filename }}" src="{{ asset('storage/'.$pImage->image->path) }}"></div>
                            @endforeach
                        </div>
                    </div>
                    <h2 class="entry-title">
                        <a href="{{ route('notice.show', $post->slug) }}">{{ $post->title ?? 'Judul' }}</a>
                    </h2>
                    <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                            <span>Penulis: <small>{!! $post->creator ? $post->creator->name : '<i>Anonim</i>' !!}</small>
                                @if(!is_null($post->publisher))
                                <br>Penerbit: <small>{{ $post->publisher->name }}</small>
                                @endif
                            </span>
                        </li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                            <a ><time datetime="2020-01-01">{{ $post->updated_at->diffForHumans() }}</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i>
                            <a >{{ $post->comments->count() }} Komentar</a></li>
                    </ul>
                    </div>

                    <div class="in-content entry-content">
                        {!! $post->content !!}
                    </div>

                    <div class="entry-footer">
                    <i class="bi bi-folder"></i>
                    <ul class="cats">
                        <li><a href="#">
                            {{ $post->postTags->count() > 1 ? $post->postTags->first()->term : 'Tidak dikategorikan' }}</a><li>
                    </ul>

                    <i class="bi bi-tags"></i>
                    <ul class="tags">
                        @forelse ($post->postTags??[] as $pTag)
                        <li><a href="#">{{ $pTag->tag->label }}</a></li>
                        @empty
                        -
                        @endforelse
                    </ul>
                    </div>

                </article>
                {{-- TODO : Comment Component --}}
            </div>

            @include('public.page.includes.aside')

          </div>

        </div>
      </section>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('frontend/vendor/owl/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/owl/owl.theme.default.min.css') }}">
@endsection

@section('js')
<script src="{{ asset('frontend/vendor/owl/owl.carousel.min.js') }}"></script>
<script>
    $("#slider1,#slider2").owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>']
    });
</script>
@endsection
