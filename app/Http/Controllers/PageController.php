<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\PostRepository;

class PageController extends Controller
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
    }

    public function index()
    {
        return redirect()->route('landing');
        // $posts = Post::search(null,'page')->orderBy('created_at', 'desc')->paginate(15);
        // return view('public.page.notice-index', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->postRepository->findBySlug($slug);
        return view('public.page.page-show', compact('post'));
    }
}
