<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostTypeSeeder::class);
        if (App::environment(['local', 'staging'])) {
            $this->call(TagSeeder::class);
            $this->call(PostSeeder::class);
            $this->call(NavigationSeeder::class);
            $this->call(FormSeeder::class);
            $this->call(DocumentSeeder::class);

            $this->call(SettingSeeder::class);
            $this->call(SectionSeeder::class);
        }
    }
}
