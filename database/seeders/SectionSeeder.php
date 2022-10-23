<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kolom =
        '<p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.</p>
        <ul><li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li></ul>
        <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum</p>';
        $about = '
      <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
        <i class="bx bx-receipt"></i>
        <h4>Layanan 1</h4>
        <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
      </div>
      <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
        <i class="bx bx-cube-alt"></i>
        <h4>Layanan 2</h4>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
      </div>
      <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
        <i class="bx bx-images"></i>
        <h4>Layanan 3</h4>
        <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
      </div>
      <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
        <i class="bx bx-shield"></i>
        <h4>Layanan 4</h4>
        <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
      </div>';
        $record = [
            '1' => ['detail','long-text','Sambutan',$kolom, asset('frontend/img/tabs-1.jpg') ],
            '3' => ['about','long-text','Tentang',$about],
            '4' => ['group-1','long-text','Kolom 1',$kolom, asset('frontend/img/tabs-1.jpg')],
            '5' => ['group-2','long-text','Kolom 2',$kolom, asset('frontend/img/tabs-2.jpg')],
            '6' => ['group-3','long-text','Kolom 3',$kolom, asset('frontend/img/tabs-3.jpg')],
            '7' => ['group-4','long-text','Kolom 4',$kolom, asset('frontend/img/tabs-4.jpg')],
            '8' => ['footer-1','long-text','Penutup Kolom 1',
                    '<li><i class="bx bx-chevron-right"></i> <a href="#">Halaman Utama</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Layanan</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Visi Misi</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Sejarah</a></li>'],
            '9' => ['footer-2','long-text','Penutup Kolom 2',
                    '<li><i class="bx bx-chevron-right"></i> <a href="#">Fitur Ke-Satu</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Fitur Ke-Dua</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Fitur Ke-Tiga</a></li>'
            ]
        ];
        foreach ($record as $key => $value) {
            Section::updateOrCreate([
                'id'    => $key,
            ], [
                'key'     => $value[0],
                'type'    => $value[1],
                'title'   => $value[2],
                'content' => value_of_key($value,3),
                'meta'    => value_of_key($value,4)
            ]);
        }
    }
}
