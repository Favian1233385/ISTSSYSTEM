<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialLinksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('social_links')->insert([
            ['name' => 'facebook', 'url' => 'https://www.facebook.com/istsucua', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'twitter', 'url' => 'https://twitter.com/istsucua', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'instagram', 'url' => 'https://www.instagram.com/istsucua', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'tiktok', 'url' => 'https://www.tiktok.com/@istsucua', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'whatsapp', 'url' => 'https://wa.me/593999999999', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
