<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ac;
use App\Models\User;
use App\Models\Chart;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $bulan = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $tahun = "2021";

        foreach ($bulan as $indeks => $namaBulan) {
            Chart::create([
                'tahun' => $tahun,
                'bulan' => $namaBulan,
                'total' => mt_rand(15, 35)
            ]);
        }

        $bulan1 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $tahun1 = "2022";

        foreach ($bulan1 as $indeks => $namaBulan) {
            Chart::create([
                'tahun' => $tahun1,
                'bulan' => $namaBulan,
                'total' => mt_rand(10, 30)
            ]);
        }

        $bulan2 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July'
        ];

        $tahun2 = "2023";

        foreach ($bulan2 as $indeks => $namaBulan2) {
            Chart::create([
                'tahun' => $tahun2,
                'bulan' => $namaBulan2,
                'total' => mt_rand(7, 30)
            ]);
        }

        Ac::factory(170)->create();
        // Task::factory(10)->create();

        User::create([
            'name' => 'Rinto Harahap',
            'email' => 'telpro012@gmail.com',
            'no_wa' => '+6283142285716',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => date('Y-m-d'),
            'nik' => "15920011",
            'image' => 'default.png',
            'password' => bcrypt('admin'),
            'status_login' => 'offline',
            'role' => 1,
            'is_active' => 1
        ]);
        User::create([
            'name' => 'Rahmat Abdullah',
            'email' => 'telkomproperty012@gmail.com',
            'no_wa' => '+6283193333382',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => date('Y-m-d'),
            'nik' => "15920012",
            'image' => 'default.png',
            'password' => bcrypt('user'),
            'status_login' => 'offline',
            'role' => 0,
            'is_active' => 0
        ]);
        User::create([
            'name' => 'Alim Darmawan',
            'email' => 'goratiz012@gmail.com',
            'nik' => "15920013",
            'image' => 'default.png',
            'password' => bcrypt('user'),
            'status_login' => 'offline',
            'role' => 0,
            'is_active' => 0
        ]);

    }
}
