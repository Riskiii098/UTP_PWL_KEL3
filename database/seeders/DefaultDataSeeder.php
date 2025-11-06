<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;

class DefaultDataSeeder extends Seeder
{
    public function run($userId): void
    {
        // Default Categories
        $categories = [
            ['name' => 'Kuliah', 'deskripsi' => 'Tugas dan aktivitas kuliah'],
            ['name' => 'Harian', 'deskripsi' => 'Aktivitas dan tugas harian'],
            ['name' => 'Organisasi', 'deskripsi' => 'Kegiatan dan tugas organisasi'],
            ['name' => 'Pribadi', 'deskripsi' => 'Tugas dan aktivitas pribadi'],
            ['name' => 'Kerja', 'deskripsi' => 'Tugas yang berhubungan dengan pekerjaan'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'deskripsi' => $cat['deskripsi'],
                'user_id' => $userId
            ]);
        }

        // Default Priorities
        $priorities = [
            ['nama' => 'Mendesak', 'level' => 5],
            ['nama' => 'Sangat Penting', 'level' => 4],
            ['nama' => 'Penting', 'level' => 3],
            ['nama' => 'Sedang', 'level' => 2],
            ['nama' => 'Biasa', 'level' => 1],
        ];

        foreach ($priorities as $pri) {
            Priority::create([
                'nama' => $pri['nama'],
                'level' => $pri['level'],
                'user_id' => $userId
            ]);
        }

        // Default Statuses
        $statuses = [
            ['nama' => 'Selesai', 'tipe' => 'Selesai', 'color' => '#10B981'],
            ['nama' => 'Sedang dikerjakan', 'tipe' => 'Sedang Dikerjakan', 'color' => '#F59E0B'],
            ['nama' => 'Belum dikerjakan', 'tipe' => 'Belum Dikerjakan', 'color' => '#c02820ff'],
        ];

        foreach ($statuses as $stat) {
            Status::create([
                'nama' => $stat['nama'],
                'tipe' => $stat['tipe'],
                'color' => $stat['color'],
                'user_id' => $userId
            ]);
        }
    }
}