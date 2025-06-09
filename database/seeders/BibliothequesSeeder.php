<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bibliotheque;

class BibliothequesSeeder extends Seeder
{
    public function run(): void
    {
        $bibliotheques = [
            [
                'nom' => 'BIBLIOTHEQUE BENIN EXCELLENCE',
                'ville' => 'Calavi',
                'adresse' => 'Adresse par défaut à Calavi',
            ],
            [
                'nom' => 'BIBLIOTHEQUE BENIN EXCELLENCE',
                'ville' => 'Godomey',
                'adresse' => 'Adresse par défaut à Godomey',
            ],
        ];

        foreach ($bibliotheques as $data) {
            Bibliotheque::create($data);
        }
    }
}
