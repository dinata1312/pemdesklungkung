<div>
    <div class="leading-normal tracking-wider text-gray-900 bg-gray-100">
        <div class="flex pb-4 -ml-3">
            <div class="mt-2 bg-white card" style="width:100%">
                <div class="card-header">
                    <h4 class="card-title">Pratinjau Navigasi</h4>
                </div>
                <div class="card-body">
                    <ul class="mr-auto navbar-nav">
                        @foreach ($navigations as $item)
                            @if (is_null($item->child_of))
                                @if ($item->child()->exists())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $item->id }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $item->label }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                                        @foreach ($item->childOrdered() as $subItem)
                                        <a class="dropdown-item" href="{{ $subItem->slug }}" target="_blank">{{ $subItem->label }}</a>
                                        @endforeach
                                    </div>
                                </li>
                                @else
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ $item->slug }}" target="_blank">{{ $item->label }} <span class="sr-only"></span></a>
                                </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
