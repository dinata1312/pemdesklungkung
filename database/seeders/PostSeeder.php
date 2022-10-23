<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Blob as Image;
use App\Models\PostImage;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            '1' => ['Tentang','1'],
            '2' => ['Sampel Pengumuman','2'],
            '3' => ['Sampel Video','3'],
            '4' => ['Sample Hero','4', '1', '1'],
            '5' => ['Sampel Produk','5'],
        ];
        $image = [
            '1' => ['penyuluhan1.jpeg', 'jpeg', 'gambar', 'frontend/img/penyuluhan1.jpeg']
        ];
        foreach($image as $key => $value) {
            Image::updateOrCreate([
                'id'        => $key
            ],[
                'filename'  => $value[0],
                'extension' => $value[1],
                'directory' => $value[2],
                'path'      => $value[3],
            ]);
        }
        foreach ($content as $key => $value) {
            $post = Post::updateOrCreate([
                'id'      => $key,
            ], [
                'title'   => $value[0],
                'slug'    => strtolower(str_replace('+','-',urlencode($value[0]))),
                'type_id' => $value[1],
                'content' => '<b>Lorem ipsum</b> dolor sit amet, consectetur adipiscing elit. Quisque consectetur purus a erat tincidunt, fermentum venenatis ex lobortis.',
                'publish' => '1'
            ]);
            if(value_of_key($value,2)){
                PostImage::updateOrcreate([
                    'id'    => value_of_key($value,3),
                ],[
                    'post_id' => $post->id,
                    'image_id' => value_of_key($value,2)
                ]);
            }
        }
    }
}
