<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Non-Fiksi', 'slug' => 'non-fiksi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Biografi', 'slug' => 'biografi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sains', 'slug' => 'sains', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Komik', 'slug' => 'komik', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Filosofi', 'slug' => 'filosofi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sosial', 'slug' => 'sosial', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kehidupan', 'slug' => 'kehidupan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Petualangan', 'slug' => 'petualangan', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Romansa', 'slug' => 'romansa', 'created_at' => $now, 'updated_at' => $now],
        ];

        Category::insert($categories);
    }
}
