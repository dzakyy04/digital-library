<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        // ID kategori yang sesuai
        $categories = [
            1 => 'Fiksi',
            2 => 'Non-Fiksi',
            3 => 'Komedi',
            4 => 'Teknologi',
            5 => 'Sejarah',
            6 => 'Sains',
            7 => 'Komik',
            8 => 'Pendidikan',
            9 => 'Filosofi',
            10 => 'Ekonomi',
            11 => 'Sosial',
            12 => 'Kesehatan',
            13 => 'Kehidupan',
            14 => 'Petualangan',
            15 => 'Romansa',
        ];

        $books = [
            [
                'title' => 'Dilan 1990',
                'slug' => 'dilan-1990',
                'category_id' => 15,
                'description' => 'Milea (Vanesha Prescilla) bertemu dengan Dilan (Iqbaal Ramadhan) di sebuah SMA di Bandung. Itu adalah tahun 1990, saat Milea pindah dari Jakarta ke Bandung. Perkenalan yang tidak biasa kemudian membawa Milea mulai mengenal keunikan Dilan lebih jauh. Dilan yang pintar, baik hati dan romantis... semua dengan caranya sendiri. Cara Dilan mendekati Milea tidak sama dengan teman-teman lelakinya yang lain, bahkan Beni, pacar Milea di Jakarta. Bahkan cara berbicara Dilan yang terdengar kaku, lambat laun justru membuat Milea kerap merindukannya jika sehari saja ia tak mendengar suara itu. Perjalanan hubungan mereka tak selalu mulus. Beni, gank motor, tawuran, Anhar, Kang Adi, semua mewarnai perjalanan itu. Dan Dilan... dengan caranya sendiri...selalu bisa membuat Milea percaya ia bisa tiba di tujuan dengan selamat. Tujuan dari perjalanan ini. Perjalanan mereka berdua. Katanya, dunia SMA adalah dunia paling indah. Dunia Milea dan Dilan satu tingkat lebih indah daripada itu.',
                'quantity' => rand(1, 100),
                'file_path' => url(Storage::url('books/files/dilan-1990.pdf')),
                'cover_path' => url(Storage::url('books/covers/dilan-1990.png')),
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Senja, Hujan dan Cerita yang Telah Usai',
                'slug' => 'senja-hujan-dan-cerita-yang-telah-usai',
                'category_id' => 1,
                'description' => 'Kenangan adalah sesuatu yang terkadang menjelma menjadi pisau, menusuk jantung paling dalam. Namun, tak jarang ada hal yang mendatangkan rindu dikala hujan dan senja datang menyapa. Salalu ada pelajaran atas segala perasaan, meski terkadang tidak tersampaikan.',
                'quantity' => rand(1, 100),
                'file_path' => url(Storage::url('books/files/senja-hujan-dan-cerita-yang-telah-usai.pdf')),
                'cover_path' => url(Storage::url('books/covers/senja-hujan-dan-cerita-yang-telah-usai.png')),
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Marmut Merah Jambu',
                'slug' => 'marmut-merah-jambu',
                'category_id' => 3,
                'description' => 'Dika menceritakan kisah cinta pertamanya saat SMA dengan cewek bernama Ina Mangunkusumo. Cerita ketika dia dan temannya Bertus membentuk sebuah grup detektif, dan juga persahabatannya dengan Cindy.',
                'quantity' => rand(1, 100),
                'file_path' => url(Storage::url('books/files/marmut-merah-jambu.pdf')),
                'cover_path' => url(Storage::url('books/covers/marmut-merah-jambu.png')),
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('books')->insert($books);
    }
}
