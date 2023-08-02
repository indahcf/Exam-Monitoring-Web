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
            'id_jadwal_pengawas'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'pengawas_yg_bertugas'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'jenis_pengawas'        => ['type' => 'enum', 'constraint' => ['Pengawas 1', 'Pengawas 2']],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_kehadiran_pengawas', true);
        $this->forge->addForeignKey('id_jadwal_pengawas', 'jadwal_pengawas', 'id_jadwal_pengawas', 'CASCADE', 'CASCADE', 'fk_jadwal_pengawas');

        $this->forge->createTable('kehadiran_pengawas', true);
    }

    public function down()
    {
        //Kehadiran Pengawas
        $this->forge->dropTable('kehadiran_pengawas', true);
    }
}
