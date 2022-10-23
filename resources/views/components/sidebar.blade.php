@php
$links = [
    [
        "href" => "admin.dashboard",
        "text" => "Dashboard",
        "icon" => "fas fa-chart-pie",
        "is_multi" => false,
        "perm" => "admin.dashboard"
    ],
    ["section" => "Pengelola",
     "perm" => ['admin.user.read','admin.privilage.role.read', 'admin.privilage.perm.read','admin.file-manager.read','admin.navigation.read']],
    [
        "href" => [
            [
                "section_text" => "Pengguna",
                "section_list" => [
                    ["href" => "admin.user", "text" => "Data Pengguna", "perm" => "admin.user.read"],
                    ["href" => "admin.user.new", "text" => "Buat Pengguna", "perm" => "admin.user.create"]
                ]
            ]
        ],
        "icon" => "fas fa-users",
        "is_multi" => true,
        "perm" => ['admin.user.read','admin.user.create']
    ],
    [
        "href" => [
            [
                "section_text" => "Hak Akses",
                "section_list" => [
                    ["href" => "admin.privilage.role", "text" => "Peran", "perm" => "admin.privilage.role.read"],
                    ["href" => "admin.privilage.permission", "text" => "Wewenang", "perm" => "admin.privilage.perm.read"]
                ]
            ]
        ],
        "icon" => "fas fa-user-tag",
        "is_multi" => true,
        "perm" => ['admin.privilage.role.read', 'admin.privilage.perm.read']
    ],
    [
        "href" => "admin.file-manager",
        "text" => "Kelola Berkas",
        "icon" => "fas fa-folder-open",
        "is_multi" => false,
        "perm" => "admin.file-manager.read"
    ],
    [
        "href" => "admin.navigation",
        "text" => "Navigasi",
        "icon" => "fas fa-compass",
        "is_multi" => false,
        "perm" => "admin.navigation.read"
    ],
    ["section" => "Konten",
     "perm" => ['admin.post.page.read','admin.post.notice.read','admin.post.video.read','admin.post.product.read']],
    [
        "href" => "admin.tag",
        "text" => "Penanda",
        "icon" => "fas fa-tags",
        "is_multi" => false,
        "perm" => "admin.tag.read"
    ],
    [
        "href" => "admin.pengumuman",
        "text" => "Pengumuman",
        "icon" => "fas fa-bullhorn",
        "is_multi" => false,
        "perm" => "admin.post.notice.read"
    ],
    [
        "href" => "admin.halaman",
        "text" => "Halaman",
        "icon" => "fas fa-newspaper",
        "is_multi" => false,
        "perm" => "admin.post.page.read"
    ],
    [
        "href" => "admin.produk",
        "text" => "Produk",
        "icon" => "fas fa-industry",
        "is_multi" => false,
        "perm" => "admin.post.product.read"
    ],
    [
        "href" => "admin.banner",
        "text" => "Baner",
        "icon" => "fas fa-pager",
        "is_multi" => false,
        "perm" => "admin.post.banner.read"
    ],
    ["section" => "Borang",
     "perm" => ['admin.dashboard']],
    [
        "href" => [
            [
                "section_text" => "Formulir",
                "section_list" => [
                    ["href" => "admin.form.index", "text" => "Data Formulir", "perm" => "admin.form.read"],
                    ["href" => "admin.form.question", "text" => "Pertanyaan", "perm" => "admin.form.read"]
                ]
            ]
        ],
        "icon" => "fas fa-list-alt",
        "is_multi" => true,
        "perm" => ['admin.form.read','admin.form.create']
    ],
    [
        "href" => [
            [
                "section_text" => "Dokumen",
                "section_list" => [
                    ["href" => "admin.document.index", "text" => "Data Dokumen", "perm" => "admin.document.read"],
                    ["href" => "admin.document.new", "text" => "Buat Dokumen", "perm" => "admin.document.create"]
                ]
            ]
        ],
        "icon" => "fas fa-file-word",
        "is_multi" => true,
        "perm" => ['admin.document.read','admin.document.create']
    ],
    [
        "href" => [
            [
                "section_text" => "Pengaturan",
                "section_list" => [
                    ["href" => "admin.setting.general", "text" => "Umum", "perm" => "admin.setting.read"],
                    ["href" => "admin.setting.section", "text" => "Bagian", "perm" => "admin.setting.read"]
                ]
            ]
        ],
        "icon" => "fas fa-cogs",
        "is_multi" => true,
        "perm" => ['admin.setting.read','admin.setting.read']
    ],

];
$navigation_links = array_to_object($links);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <x-jet-authentication-card-logo class="w-auto h-6 d-inline-block" />
            </a>
        </div>
        @foreach ($navigation_links as $link)
        <ul class="sidebar-menu">
            @if (isset($link->section))
            @if (anyPerm($link->perm))
            <li class="menu-header">{{ $link->section }}</li>
            @endif
            @else
                @if (!$link->is_multi)
                @if (anyPerm($link->perm))
                <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($link->href) }}"><i class="{{ $link->icon ?? 'fas fa-fire' }}"></i><span>{{ $link->text }}</span></a>
                </li>
                @endif
                @else
                    @foreach ($link->href as $section)
                        @php
                        $routes = collect($section->section_list)->map(function ($child) {
                            return Request::routeIs($child->href);
                        })->toArray();

                        $is_active = in_array(true, $routes);
                        @endphp
                        @if (anyPerm($link->perm))
                        <li class="dropdown {{ ($is_active) ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $link->icon ?? 'fas fa-chart-bar' }}"></i> <span>{{ $section->section_text }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach ($section->section_list as $child)
                                    @if (perm($child->perm))
                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    @endforeach
                @endif
            @endif
        </ul>
        @endforeach
    </aside>
</div>
