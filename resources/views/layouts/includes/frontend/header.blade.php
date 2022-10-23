<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="{{ route('landing') }}">
        {{ app_name()[0] }} <span>{{ value_of_key(app_name(),1) }}</span></a>
      </h1>

      <nav id="navbar" class="order-last navbar order-lg-0">
        <ul>
            @php
                $navigations = \App\Models\Navigation::orderBy('sequence','asc')->get();
            @endphp
            @foreach ($navigations as $item)
                @if (is_null($item->child_of))
                    @if ($item->child()->exists())
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $item->id }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $item->label }}
                        </a>
                        <ul aria-labelledby="navbarDropdown{{ $item->id }}">
                            @foreach ($item->childOrdered() as $subItem)
                            <li><a class="dropdown-item" href="{{ $subItem->slug }}">{{ $subItem->label }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li>

                        @if (!is_last($navigations, $loop))
                            <a class="nav-link" href="{{ $item->slug }}">{{ $item->label }} <span class="sr-only"></span></a>
                        @else
                            @php
                                $last['slug'] = $item->slug;
                                $last['label'] = $item->label;
                            @endphp
                        @endif
                    </li>
                    @endif
                @endif
            @endforeach
          {{-- <li><a class="nav-link scrollto active" href="{{ route('landing') }}">Halaman Utama</a></li>
          <li><a class="nav-link scrollto" href="{{ route('landing') }}#about">Layanan Desa</a></li>
          <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Sejarah Desa</a></li>
              <li><a href="#">Sekilas Desa Klungkung</a></li>
              <li><a href="#">Pemerintahan Desa</a></li>
            </ul>
          </li> --}}
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <a href="{{ value_of_key($last,'slug') }}" class="get-started-btn scrollto">{{ value_of_key($last,'label') }}</a>
    </div>
</header>
