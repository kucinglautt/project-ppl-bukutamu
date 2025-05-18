<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyGuestSeeder extends Seeder
{
    public function run()
    {
        $dataGuests = [];

        for ($i = 0; $i < 20; $i++) {
            $dataGuests[] = [
                'name'         => "Tamu $i",
                'institution'  => 'Instansi ' . chr(65 + ($i % 5)), // A, B, C, D, E
                'purpose'      => 'Konsultasi',
                'created_at'   => date('Y-m-d H:i:s', strtotime("-$i days")),
            ];
        }

        $this->db->table('guests')->insertBatch($dataGuests);

        $this->db->table('users')->insert([
            'username' => 'petugas1',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role'     => 'petugas',
        ]);
    }
}
