<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        // === USERS TABLE ===
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'ENUM', 'constraint' => ['admin', 'petugas']],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // === GUESTS TABLE ===
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'auto_increment' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'institution'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'purpose'      => ['type' => 'TEXT', 'null' => true],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('guests');

        // === VISITS TABLE ===
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true],
            'guest_id'   => ['type' => 'INT'],
            'check_in'   => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'check_out'  => ['type' => 'DATETIME', 'null' => true],
            'status'     => ['type' => 'ENUM',   'constraint' => ['hadir', 'selesai', 'batal'], 'default' => 'hadir'],
            'handled_by' => ['type' => 'INT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('guest_id', 'guests', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('handled_by', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('visits');
    }

    public function down()
    {
        $this->forge->dropTable('visits');
        $this->forge->dropTable('guests');
        $this->forge->dropTable('users');
    }
}
