<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting\Section;
use App\Models\Setting\Setting;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::get();
        $settings = Setting::get();
        $hero     = Post::search(null, 'hero')->whereIn('publish', [1])->first();
        $about    = Post::search(null, 'page')->whereIn('publish', [1])->where('title','like','%tentang%')->first();

        $tags    = Tag::withCount('postTags')->latest('post_tags_count')->take(7)->with('postTags')->get();
        $notices = Post::search(null, 'notice')->whereIn('publish', [1])->get();
        return view('frontend.landing',
        compact('sections', 'settings',
                'hero', 'about',
                'tags', 'notices'
            ));
    }

    public function sendWA(Request $request)
    {
        $phone = Setting::where('key','phone')->first()->value;
        $base = 'https://api.whatsapp.com/send?phone='.phone_validate($phone);
        $content ="Halo ".app_name(true).", Saya *".$request->name ?? 'Anonim'."*
Topik: ".$request->subject ?? '-'."
Kontak: ".$request->email ?? '-'."
Pesan: ".$request->message ?? 'Saya ingin menghubungi anda';
        $text = $base.'&text='.urlencode($content);
        return redirect()->to($text);
    }
}
