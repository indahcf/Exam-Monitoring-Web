<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateJadwalUjianTable extends Migration
{
    public function up()
    {
        //Jadwal Ujian
        $this->forge->addField([
            'id_jadwal_ujian'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment'    => true],
            'id_prodi'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_kelas'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_dosen'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_ruang_ujian'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_tahun_akademik'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'jumlah_peserta'        => ['type' => 'int', 'constraint' => 11],
            'tanggal'               => ['type' => 'date'],
            'jam_mulai'             => ['type' => 'time'],
            'jam_selesai'           => ['type' => 'time'],
            'total_hadir'           => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'jumlah_lju'            => ['type' => 'int', 'constraint' => 11, 'null' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_jadwal_ujian', true);
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas');
        $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');
        $this->forge->addForeignKey('id_ruang_ujian', 'ruang_ujian', 'id_ruang_ujian');
        $this->forge->addForeignKey('id_tahun_akademik', 'tahun_akademik', 'id_tahun_akademik');

        $this->forge->createTable('jadwal_ujian', true);
    }

    public function down()
    {
        //Jadwal Ujian
        $this->forge->dropTable('jadwal_ujian', true);
    }
}
