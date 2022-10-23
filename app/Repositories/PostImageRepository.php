<?php

namespace App\Repositories;

use App\Models\PostImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostImageRepository extends Repository
{

    public function __construct()
    {
        $this->model = new PostImage;
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
        foreach ($arr as $key => $item) {
            if($item != false){
                $this->model->create([
                    'post_id' => $id,
                    'image_id' => $key
                ]);
            }
        }
    }

    /**
     * getTagByPostId
     *
     * @param  mixed $id
     * @return object
     */
    public function getImageByPostId($id)
    {
        return $this->model->where('post_id', $id)->select('image_id')->get();
    }

    /**
     * destroyTagByPostId
     *
     * @param  mixed $id
     * @return void
     */
    public function destroyImageByPostId($id)
    {
        return DB::table('post_image')->where('post_id', $id)->delete();
    }
}
