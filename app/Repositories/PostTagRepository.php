<?php

namespace App\Repositories;

use App\Models\PostTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostTagRepository extends Repository
{

    public function __construct()
    {
        $this->model = new PostTag;
    }

    /**
     * MassCreate
     *
     * @param  array $arr
     * @param  int $id
     * @return void
     */
    public function massCreate(Array $arr, Int $id)
    {
        foreach ($arr as $item) {
            $this->model->create([
                'post_id' => $id,
                'tag_id' => $item
            ]);
        }
    }

    /**
     * getTagByPostId
     *
     * @param  mixed $id
     * @return object
     */
    public function getTagByPostId($id)
    {
        // return $this->model->where('post_id', $id)->select(['tag_id'])->with('tag:id,label')->get();
        return $this->model->where('post_id', $id)->select('tag_id')->get();
    }

    /**
     * destroyTagByPostId
     *
     * @param  mixed $id
     * @return void
     */
    public function destroyTagByPostId($id)
    {
        return DB::table('post_tag')->where('post_id', $id)->delete();
    }
}
