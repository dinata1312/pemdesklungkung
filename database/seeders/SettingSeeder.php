<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = [
            '1' => ['maintenance','boolean',0],
            '2' => ['facebook','text','https://facebook.com'],
            '3' => ['instagram','text','https://instagram.com'],
            '4' => ['linkedin','text','https://linkedin.com'],
            '5' => ['twitter','text','https://twitter.com'],
            '6' => ['email','text','email@gmail.com'],
            '7' => ['phone','text','0800-0000-000'],
            '8' => ['address','long-text', 'Jl. Kenangan Bersamamu IX No 9']
        ];
        foreach ($record as $key => $value) {
            Setting::updateOrCreate([
                'id'    => $key,
            ], [
                'key' => $value[0],
                'type' => $value[1],
                'value'  => $value[2]
            ]);
        }
    }
}
