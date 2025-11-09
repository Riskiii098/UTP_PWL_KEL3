<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mood;

class MoodSeeder extends Seeder
{
    public function run(): void
    {
        $moods = [
            ['name' => 'Senang', 'emoji' => '😊'],
            ['name' => 'Biasa', 'emoji' => '😐'],
            ['name' => 'Capek', 'emoji' => '😩'],
            ['name' => 'Stres', 'emoji' => '😭'],
        ];

        foreach ($moods as $mood) {
            Mood::create($mood);
        }
    }
}
