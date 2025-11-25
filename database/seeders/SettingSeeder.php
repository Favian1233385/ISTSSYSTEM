<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['key' => 'institute_name', 'value' => 'Instituto Superior Tecnológico Sucúa'],
            ['key' => 'institute_motto', 'value' => 'Formando profesionales para el futuro'],
            ['key' => 'contact_address', 'value' => 'Av. Principal 123, Sucúa - Ecuador'],
            ['key' => 'contact_phone', 'value' => '(07) 123-4567'],
            ['key' => 'contact_email', 'value' => 'info@ists.edu.ec'],
            ['key' => 'contact_hours', 'value' => 'Lun-Vie: 8:00 AM - 6:00 PM'],
            ['key' => 'social_facebook', 'value' => 'https://www.facebook.com'],
            ['key' => 'social_twitter', 'value' => 'https://www.twitter.com'],
            ['key' => 'social_instagram', 'value' => 'https://www.instagram.com'],
            ['key' => 'social_linkedin', 'value' => 'https://www.linkedin.com'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
