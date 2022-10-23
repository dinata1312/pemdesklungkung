<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostType;


class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $record = [
            '1' => ['page','halaman'],
            '2' => ['notice', 'pengumuman'],
            '3' => ['video', 'video'],
            '4' => ['hero', 'hero'],
            '5' => ['product', 'produk'],
        ];
        foreach ($record as $key => $value) {
            PostType::updateOrCreate([
                'id'    => $key,
            ], [
                'label' => $value[0],
                'slug'  => $value[1]
            ]);
        }
    }
}
