<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateJadwalRuangTable extends Migration
{
    public function up()
    {
        //Jadwal Ruang
        $this->forge->addField([
            'id_jadwal_ruang'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment'    => true],
            'id_jadwal_ujian'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_ruang_ujian'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_jadwal_ruang', true);
        $this->forge->addForeignKey('id_jadwal_ujian', 'jadwal_ujian', 'id_jadwal_ujian');
        $this->forge->addForeignKey('id_ruang_ujian', 'ruang_ujian', 'id_ruang_ujian');

        $this->forge->createTable('jadwal_ruang', true);
    }

    public function down()
    {
        //Jadwal Ruang
        $this->forge->dropTable('jadwal_ruang', true);
    }
}
