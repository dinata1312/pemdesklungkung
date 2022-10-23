<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Post;
    }

    public function createByType(string $type, array $data)
    {
        $postType           = PostType::select('id','label')->where('label',$type)->first();
        $data['type_id']    = $postType->id;
        $data['created_by'] = Auth::user()->id;
        $data['slug']       = urlencode($data['slug']);
        return Post::create($data);
    }

    public function allByType(string $postType)
    {
        return $this->model->with('postType')->whereHas("postType",function($q) use($postType){
            $q->whereLabel==$postType;
            });
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
