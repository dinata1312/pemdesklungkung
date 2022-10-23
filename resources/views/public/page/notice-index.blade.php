
@extends('layouts.frontend')
@section('title', "Berita")

@section('content')
    <section class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('landing') }}">Beranda</a></li>
            <li><a href="#">Pengumuman</a></li>
          </ol>
          <h2>Berita</h2>
        </div>
    </section>

      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
          <div class="row">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        <h2 class="text-center entry-title">
                            Berita
                        </h2>
                        <hr>
                        <div class="in-content entry-content">
                            @forelse ($posts as $post)
                            <div class="m-4 ml-2 mr-2 row">
                                <div class="col-lg-3">
                                    <div class="image-box" style="background-image: url('{{ thumbnail($post) }}')"
                                        style="max-height: 45px;"></div>
                                </div>
                                <div class="col-lg-9">
                                    <h2><a href="{{ route('notice.show',$post->slug) }}">{{ $post->title }}</a></h2>
                                    <div class="entry-meta">
                                        <ul>
                                            <li class="d-flex align-items-center"><i class="bi bi-person"></i>
                                                Penulis: {!! $post->creator ? $post->creator->name : '<i>Anonim</i>' !!}
                                            </li>
                                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                                <a ><time datetime="2020-01-01">{{ $post->updated_at->diffForHumans() }}</time></a></li>
                                        </ul>
                                    </div>
                                    <p>{!! Str::limit($post->content, 160) !!}</p>
                                </div>
                            </div>
                            @empty
                                <h3>Tidak ada hasil</h3>
                            @endforelse
                            <div style="paginate">
                                {{ $posts->withQueryString()->links('vendor.pagination.public-custom') }}
                            </div>
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
