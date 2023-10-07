<?php

namespace Database\Seeders;

use App\Models\Anuncio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnunciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anuncio::updateOrCreate([
            'id'=>1,
            'user_id'=>1,
            'title' => 'coche deportivo',
            'short_description'=>'Coche muy rapido',
            'long_description'=>'Este coche veras que es muy bueno compramelo',
            'phone'=>'666666666',
            'email'=>'test@test.com'
        ]);
        Anuncio::updateOrCreate([
            'id'=>2,
            'user_id'=>1,
            'title' => 'coche para trabjo',
            'short_description'=>'Coche muy lento',
            'long_description'=>'Este coche va muy lento pero va bien',
            'phone'=>'77777777',
            'email'=>'test2@test.com'
        ]);
    }
}
