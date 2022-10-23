<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Navigation;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nav = [
            '1' => ['Beranda', env('APP_URL').'home', null],
            '2' => ['Konten', env('APP_URL').'Konten', null],
            '3' => ['Pengumuman', env('APP_URL').'pengumuman', '2'],
            '4' => ['Login', env('APP_URL').'login', null],
            '5' => ['Register', env('APP_URL').'register', null],
        ];
        foreach ($nav as $key => $value) {
            Navigation::updateOrCreate([
                'id'    => $key,
            ], [
                'label'    => $value[0],
                'slug'     => $value[1],
                'child_of' => $value[2],
                'sequence' => $key
            ]);
        }
    }
}
