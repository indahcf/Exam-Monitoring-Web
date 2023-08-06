<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateKejadianTable extends Migration
{
    public function up()
    {
        //Kejadian
        $this->forge->addField([
            'id_kejadian'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_jadwal_ruang'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'nim'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'nama_mhs'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'jenis_kejadian' => ['type' => 'enum', 'constraint' => ['Menyontek', 'Ke Toilet/Tidak Mencurigakan', 'Tidak Tercantum Di Absen', 'Lain-lain'], 'null' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_kejadian', true);
        $this->forge->addForeignKey('id_jadwal_ruang', 'jadwal_ruang', 'id_jadwal_ruang');

        $this->forge->createTable('kejadian', true);
    }

    public function down()
    {
        //Kejadian
        $this->forge->dropTable('kejadian', true);
    }
}
