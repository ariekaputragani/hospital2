<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Doctor::create([
            'pp' => 'images/doctors/author.jpg',
            'poli_id' => '1',
            'name' => 'Dr. Indah Lestary, Sp. P',
            'slug' => \Str::slug('Dr. Indah Lestary, Sp.P'),
            'desc' => 'Saya suka minum jus orange, saya suka warna kuning. Instagram: @indah_lestary70',
            'birthdate' => '1998-05-22',
            'phone' => '083159738239',
            'email' => 'indahlestary70@gmail.com',
            'address' => 'Jl. TB Simatupang No.89, RT.1/RW.2, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520',
            'sen_start' => '08:00',
            'sen_end' => '15:00',
            'sel_start' => '08:00',
            'sel_end' => '15:00',
            'rab_start' => '08:00',
            'rab_end' => '15:00',
            'kam_start' => '08:00',
            'kam_end' => '15:00',
            'jum_start' => '08:00',
            'jum_end' => '15:00',
            'sab_start' => '08:00',
            'sab_end' => '15:00',
        ]);
    }
}
