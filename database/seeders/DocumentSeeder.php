<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            '1' => ['Dokumen Kop Saja'],
            '2' => ['Sample Dokumen'],
        ];
        foreach ($content as $key => $value) {
            Document::updateOrCreate([
                'id'    => $key,
            ], [
                'title' => $value[0],
                'content' => '<b>Lorem ipsum</b> dolor sit amet, consectetur adipiscing elit. Quisque consectetur purus a erat tincidunt, fermentum venenatis ex lobortis. Ut interdum eros sit amet feugiat congue. Sed ut urna sit amet nisl maximus vehicula a in metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent interdum leo in turpis ornare dictum. Vestibulum elit ex, egestas in massa quis, feugiat scelerisque leo. Nulla tempus diam vel libero consectetur dictum. In hac habitasse platea dictumst.'
            ]);
        }
    }
}
