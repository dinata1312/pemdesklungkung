<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['darkun7', 'hartawan@smartservices.id', 'Super Admin'],
            ['noobiesdev', 'fernaldi@smartservices.id', 'Developer'],
            ['admin', 'admin@mail.id', 'Admin'],
            ['editor', 'editor@mail.id', 'Editor'],
            ['copyeditor', 'copyeditor@mail.id', 'Copyeditor'],
            ['writer', 'writer@mail.id', 'Writer'],
    ];
        foreach ($users as $key => $value) {
            $user = User::updateOrCreate([
                'id'    => $key+1,
            ], [
                'name' => $value[0],
                'username' => $value[0],
                'email' => $value[1],
                'email_verified_at' => now(),
                'password' => bcrypt('ijinmasuk'),
                'remember_token' => Str::random(10),
            ]);
            $user->assignRole($value[2]);
        }
    }
}
