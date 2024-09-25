<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PoliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $polis = collect(['Poli Umum','Poli Anak','Poli Andrologi','Poli Bedah Anak','Poli Bedah Plastik','Poli Bedah Toraks Kardiovaskuler','Poli Bedah Umum','Poli Farmakologi Klinik',
        'Poli Gizi','Poli Jantung','Poli Jiwa','Poli Kardiologi','Poli Kedokteran Gigi','Poli Kulit dan Kelamin','Poli Lansia','Poli Mata','Poli MCU','Poli Nefrologi','Poli Neurologi',
        'Poli Obsgyn','Poli Paru','Poli Penyakit Dalam','Poli Penyakit Mulut','Poli Radiologi','Poli Rehabilitasi Medik','IGD']);
        $polis->each(function ($c) {
            \App\Models\Poli::create([
                'name' => $c,
            ]);
        });
    }
}
