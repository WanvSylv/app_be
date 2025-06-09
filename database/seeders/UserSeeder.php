<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // SuperAdmin
        $user1 = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'nom' => 'WANVOEGBE',
                'prenom' => 'Sylvain',
                'tel' => '0167043760',
                'password' => bcrypt('password'),
                'bibliotheque_id' => 1, // car SuperAdmin peut ne pas être lié à un établissement
            ]
        );
        $user1->assignRole('SuperAdmin');

        // Admin Godomey
        $user2 = User::firstOrCreate(
            ['email' => 'godomey@example.com'],
            [
                'nom' => 'DOSSA',
                'prenom' => 'Louis',
                'tel' => '0197000001',
                'password' => bcrypt('password'),
                'bibliotheque_id' => 1, // Id d’un établissement Godomey
            ]
        );
        $user2->assignRole('AdminGodomey');

        // Admin Calavi
        $user3 = User::firstOrCreate(
            ['email' => 'calavi@example.com'],
            [
                'nom' => 'AGOSSOU',
                'prenom' => 'David',
                'tel' => '0197000002',
                'password' => bcrypt('password'),
                'bibliotheque_id' => 2, // Id d’un établissement Calavi
            ]
        );
        $user3->assignRole('AdminCalavi');

        // Bibliothécaire
        $user4 = User::firstOrCreate(
            ['email' => 'biblio@example.com'],
            [
                'nom' => 'GBAGUIDI',
                'prenom' => 'Fabrice',
                'tel' => '0197000003',
                'password' => bcrypt('password'),
                'bibliotheque_id' => 1, // Id d’un établissement bibliothèque
            ]
        );
        $user4->assignRole('Bibliothecaire');
    }
}
