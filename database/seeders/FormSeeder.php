<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form\Form;
use App\Models\Form\Question;
use App\Models\Form\FormQuestion;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Form::updateOrCreate([
            'id'    => 1,
        ], [
            'name'   => "Formulir Sampel",
            'desc'   => "Ini adalah formulir uji coba sebagai panduan untuk formulir berikutnya",
            'closed' => '1',
        ]);

        $questions = [
            ['text','name', "Nama Lengkap", null],
            ['email','email', "Alamat Email", null],
            ['date','dob', "Tanggal Lahir", null],
            ['radio','gender', "Jenis kelamin", ["option"=>['laki-laki', 'perempuan']]],
            ['select-one','academic', "Pendidikan terakhir", ["option"=>['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3']]],
            ['select-multiple','hobby', "Hobi", ["option"=>['Catur', 'Sepak bola', 'Menyanyi', 'Menggambar']]],
            ['number','relative', "Jumlah Saudara", null],
            ['long-text','bio', "Auto Biografi", null],
            ['file-upload','pict', "Foto Diri", ["type"=>'image',"directory"=>'attachment',"validation"=>['image|mimes:jpeg,png,jpg,gif,svg|max:2048']]],
            ['file-upload','resume', "CV", ["type"=>'file',"directory"=>'attachment',"validation"=>['max:2048']]],
        ];
        foreach ($questions as $key => $value) {
            Question::updateOrCreate([
                'id' => $key+1,
            ], [
                'type'   => $value[0],
                'marker' => $value[1],
                'label'  => $value[2],
                'meta'   => json_encode($value[3]),
            ]);
        }
        for ($i = 0; $i < count($questions); $i++)
        {
            FormQuestion::updateOrCreate([
                'id' => $i+1,
            ], [
                'form_id' => 1,
                'question_id' => $i+1,
                'sequence' => $i+1
            ]);
        }
    }
}
