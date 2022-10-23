<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Term;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = [
            '1' => 'Teknologi',
            '2' => 'Edukasi',
            '3' => 'Permainan',
        ];
        foreach ($terms as $key => $value) {
            Term::updateOrCreate([
                'id'    => $key,
            ], [
                'label' => $value,
            ]);
        }

        $tags = [
            '1' => ['Kecerdasan Buatan','Big Data', 'Blockchain', 'Komputasi Awan'],
            '2' => ['Siswa', 'Mahasiswa', 'Berpikir Kritis'],
            '3' => ['Teka-Teki', 'Tantangan', 'Petualangan', 'Sandbox'],
        ];
        foreach ($tags as $key => $value) {
            foreach ($value as $item){
                Tag::create(
                [
                    'term_id' => $key,
                    'label' => $item,
                ]);
            }
        }
    }
}
