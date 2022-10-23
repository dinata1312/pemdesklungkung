<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Term;

class PostController extends Controller
{
    public function tag()
    {
        return view('admin.post.tag.tag-data', [
            'tag'  => Tag::class,
            'term' => Term::class
        ]);
    }


    public function page()
    {
        return view('admin.post.page.halaman-data', [
            'halaman' => Post::class
        ]);
    }

    public function notice()
    {
        return view('admin.post.notice.pengumuman-data', [
            'pengumuman' => Post::class
        ]);
    }

    public function hero()
    {
        return view('admin.post.hero.banner-data', [
            'banner' => Post::class
        ]);
    }

    public function product()
    {
        return view('admin.post.product.produk-data', [
            'produk' => Post::class
        ]);
    }
}
