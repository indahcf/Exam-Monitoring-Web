<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateKehadiranPesertaTable extends Migration
{
    public function up()
    {
        //Kehadiran Peserta
        $this->forge->addField([
            'id_kehadiran_peserta'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_jadwal_ruang'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'total_hadir' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'sakit' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nim_sakit'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'izin' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nim_izin'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'tanpa_ket' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nim_tanpa_ket' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'tidak_memenuhi_syarat' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nim_tidak_memenuhi_syarat'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'presensi_kurang' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nim_presensi_kurang'  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'jumlah_lju' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_kehadiran_peserta', true);
        $this->forge->addForeignKey('id_jadwal_ruang', 'jadwal_ruang', 'id_jadwal_ruang');

        $this->forge->createTable('kehadiran_peserta', true);
    }

    public function down()
    {
        //Kehadiran Peserta
        $this->forge->dropTable('kehadiran_peserta', true);
    }
}
