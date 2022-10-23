<div class="col-lg-4">
    @php
    $terms = \App\Models\Term::get();
    $tags = \App\Models\Tag::withCount('postTags')->latest('post_tags_count')->take(10)->with('postTags')->get();
    $posts = \App\Models\Post::search(null, 'notice')->whereIn('publish', [1])->orderBy('created_at', 'desc')->take(5)->get();
    @endphp
    <div class="sidebar">
        <h3 class="sidebar-title">Pencarian</h3>
        <div class="sidebar-item search-form">
            <form action="">
                <input type="text">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>
            </div>
            <h3 class="sidebar-title">Kategori</h3>
            <div class="sidebar-item categories">
                <ul>
                    @foreach ($terms as $term)
                    <li><a href="#">{{ $term->label }} <span>( {{ $term->countPost() }} )</span></a></li>
                    @endforeach
                </ul>
            </div>

            <h3 class="sidebar-title">Berita Terbaru</h3>
            <div class="sidebar-item recent-posts">
                @foreach ($posts as $post)
                <div class="clearfix post-item">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('notice.show',$post->slug) }}">
                            <div class="image-box" style="background-image: url('{{ thumbnail($post) }}');
                                max-width: 70px;max-height: 70px;"></div></a>
                        </div>
                        <div class="col-lg-9">
                            <h4 style="margin-left:0"><a href="{{ route('notice.show',$post->slug) }}">{{ $post->title }}</a></h4>
                            <span>{{ $post->created_at->isoFormat('dddd, Do MMMM YYYY') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>

        <h3 class="sidebar-title">Tags</h3>
        <div class="sidebar-item tags">
            <ul>
                @foreach ($tags as $tag)
                <li><a href="#">{{ $tag->label }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

  </div>
