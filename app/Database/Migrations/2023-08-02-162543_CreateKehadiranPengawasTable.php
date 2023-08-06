<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateKehadiranPengawasTable extends Migration
{
    public function up()
    {
        //Kehadiran Pengawas
        $this->forge->addField([
            'id_kehadiran_pengawas'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_jadwal_ruang'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'pengawas_1'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'pengawas_2'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'pengawas_3'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_kehadiran_pengawas', true);
        $this->forge->addForeignKey('id_jadwal_ruang', 'jadwal_ruang', 'id_jadwal_ruang');
        $this->forge->addForeignKey('pengawas_1', 'pengawas', 'id_pengawas');
        $this->forge->addForeignKey('pengawas_2', 'pengawas', 'id_pengawas');
        $this->forge->addForeignKey('pengawas_3', 'dosen', 'id_dosen');

        $this->forge->createTable('kehadiran_pengawas', true);
    }

    public function down()
    {
        //Kehadiran Pengawas
        $this->forge->dropTable('kehadiran_pengawas', true);
    }
}
