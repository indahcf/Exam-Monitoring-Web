<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateJadwalPengawasTable extends Migration
{
    public function up()
    {
        //Jadwal Pengawas
        $this->forge->addField([
            'id_jadwal_pengawas'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_jadwal_ruang'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_pengawas'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_jadwal_pengawas', true);
        $this->forge->addForeignKey('id_jadwal_ruang', 'jadwal_ruang', 'id_jadwal_ruang', 'CASCADE', 'CASCADE', 'fk_jadwal_ruang');
        $this->forge->addForeignKey('id_pengawas', 'pengawas', 'id_pengawas', 'CASCADE', 'CASCADE', 'fk_pengawas');

        $this->forge->createTable('jadwal_pengawas', true);
    }

    public function down()
    {
        //Jadwal Pengawas
        $this->forge->dropTable('jadwal_pengawas', true);
    }
}
