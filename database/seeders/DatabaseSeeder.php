<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel des seeders nécessaires
        $this->call([
            BibliothequesSeeder::class,
        ]);
        
        $this->call(RoleSeeder::class);
        
      $this->call([
    UserSeeder::class,
]); 


    }
}


