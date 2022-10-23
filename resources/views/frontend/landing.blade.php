@extends('layouts.frontend')
@section('title', "Halaman Utama")

@section('content')
<section id="hero" class="d-flex align-items-center"
    style='background: url("{{ $hero ? $hero->postImages->first()->image->path : asset('frontend/img/penyuluhan1.jpeg') }}") top center no-repeat;background-size: cover;'>
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <div class="row">
        <div class="col-xl-6">
          <h1>{{ $hero->title ?? app_name(true) }}</h1>
          <h2>{!! $hero->content ?? '' !!}</h2>
        </div>
      </div>
    </div>
</section>

<section id="clients" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="row">
        <div class="order-2 mt-3 col-lg-6 order-lg-1 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
          <h3>{{ collection_match($sections, 'key', 'detail', 'title') }}</h3>
            {!! collection_match($sections, 'key', 'detail', 'content') !!}
        </div>
        <div class="order-1 text-center col-lg-6 order-lg-2" data-aos="fade-up" data-aos-delay="200">
          <img src="{{ collection_match($sections, 'key', 'detail', 'meta') }}" alt="" class="img-fluid img-front">
        </div>
      </div>

    </div>
</section>

<section id="about" class="about section-bg">
    <div class="container" data-aos="fade-up">

      <div class="row no-gutters">
        <div class="content col-xl-5 d-flex align-items-stretch">
          <div class="">
            <h3>{{ app_name(true) }}</h3>
            <p>
              {!! $about ? Str::limit($about->content, 255) : '' !!}
            </p>
            <a href="#" class="about-btn"><span>Tentang</span> <i class="bx bx-chevron-right"></i></a>
          </div>
        </div>
        <div class="col-xl-7 d-flex align-items-stretch">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
                {!! collection_match($sections, 'key', 'about', 'content') !!}
            </div>
          </div>
        </div>
      </div>

    </div>
</section>

<section id="tabs" class="tabs">
    <div class="container" data-aos="fade-up">
        <ul class="nav nav-tabs row d-flex">
            @for ($i=1;$i<=4 ;$i++)
            <li class="nav-item col-3">
            <a class="nav-link @if($i==1)active show @endif" data-bs-toggle="tab" data-bs-target="#tab-{{ $i }}">
                <i class="ri-gps-line"></i>
                <h4 class="d-none d-lg-block">{{ collection_match($sections, 'key', 'group-'.$i, 'title') }}</h4>
            </a>
            </li>
            @endfor
        </ul>
        <div class="tab-content">
            @for ($i=1;$i<=4 ;$i++)
                <div class="tab-pane @if($i==1)active show @endif" id="tab-{{ $i }}">
                    <div class="row">
                        <div class="order-2 mt-3 col-lg-6 order-lg-1 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
                        <h3>{{ collection_match($sections, 'key', 'group-'.$i, 'title') }}</h3>
                        {!! collection_match($sections, 'key', 'group-'.$i, 'content') !!}
                        </div>
                        <div class="order-1 text-center col-lg-6 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ collection_match($sections, 'key', 'group-'.$i, 'meta') }}" alt="" class="img-fluid img-front">
                        </div>
                    </div>
                </div>
            @endfor
            </div>
        </div>

    </div>
</section>

<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Berita</h2>
        <p>Berita terkait</p>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">Semua</li>
            @foreach ($tags as $tag)
            <li data-filter=".filter-{{ no_space($tag->label) }}">{{ $tag->label }}</li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        @foreach ($notices as $notice)
        @php
            $img = thumbnail($notice);
            $tags = $notice->postTags;
            $category = [];
            foreach($tags as $tag){array_push($category, no_space($tag->tag->label));}

        @endphp
        <div class="col-lg-4 col-md-6 portfolio-item {{ 'filter-'.implode(' filter-', $category) }}">
            <div class="portfolio-wrap">
              <img src="{{ $img }}" class="img-fluid" alt="">
              <div class="portfolio-info">
                  <h4>{{ $notice->title }}</h4>
                  <p>{!! Str::limit($notice->content, 65) !!}</p>
                <div class="portfolio-links">
                  <a href="{{ $img }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $notice->title }}"><i class="bx bx-plus"></i></a>
                  <a href="{{ route('notice.show', $notice->slug) }}" title="Selengkapnya"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
        </div>
        @endforeach
      </div>

    </div>
</section>

<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Hubungi Kami</h2>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Alamat Kami</h3>
                <p>{{ collection_match($settings, 'key', 'address', 'value') }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mt-4 info-box">
                <i class="bx bx-envelope"></i>
                <h3>Surel</h3>
                <p>{{ collection_match($settings, 'key', 'email', 'value') }}</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mt-4 info-box">
                <i class="bx bx-phone-call"></i>
                <h3>Telepon</h3>
                <p>{{ collection_match($settings, 'key', 'phone', 'value') }}</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6">
          <form action="{{ route('contactWA') }}" method="post"  class="message-form">
            @csrf
            <div class="row">
              <div class="col form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
              </div>
              <div class="col form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Alamat Email" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Judul" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Pesan" required></textarea>
            </div>
            {{-- <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div> --}}
            <div class="text-center"><button type="submit" target="_blank">Kirim Pesan</button></div>
          </form>
        </div>

      </div>

    </div>
</section>
@endsection
