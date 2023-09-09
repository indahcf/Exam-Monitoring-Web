<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateSoalUjianTable extends Migration
{
    public function up()
    {
        //Soal Ujian
        $this->forge->addField([
            'id_soal_ujian'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_tahun_akademik'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_dosen'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'soal_ujian'            => ['type' => 'varchar', 'constraint' => 1000],
            'status_soal'           => ['type' => 'enum', 'constraint' => ['Menunggu Direview', 'Revisi', 'Diterima', 'Dicetak'], 'default' => 'Menunggu Direview'],
            'bentuk_soal'           => ['type' => 'enum', 'constraint' => ['Uraian', 'Pilihan Ganda', 'Uraian dan Pilihan Ganda']],
            'metode'                => ['type' => 'enum', 'constraint' => ['Luring', 'Daring']],
            'durasi_pengerjaan'     => ['type' => 'enum', 'constraint' => ['Ada', 'Tidak Ada'], 'null' => true],
            'sifat_ujian'           => ['type' => 'enum', 'constraint' => ['Ada', 'Tidak Ada'], 'null' => true],
            'petunjuk'              => ['type' => 'enum', 'constraint' => ['Ada', 'Tidak Ada'], 'null' => true],
            'sub_cpmk'              => ['type' => 'enum', 'constraint' => ['Ya', 'Tidak'], 'null' => true],
            'durasi_sks'            => ['type' => 'enum', 'constraint' => ['Ya', 'Tidak'], 'null' => true],
            'pertanyaan'            => ['type' => 'enum', 'constraint' => ['Ya', 'Tidak'], 'null' => true],
            'skor'                  => ['type' => 'enum', 'constraint' => ['Ya', 'Tidak'], 'null' => true],
            'gambar'                => ['type' => 'enum', 'constraint' => ['Ya', 'Tidak'], 'null' => true],
            'catatan'               => ['type' => 'longtext', 'null' => true],
            'saran'                 => ['type' => 'longtext', 'null' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_soal_ujian', true);
        $this->forge->addForeignKey('id_tahun_akademik', 'tahun_akademik', 'id_tahun_akademik');
        $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');

        $this->forge->createTable('soal_ujian', true);
    }

    public function down()
    {
        //Soal Ujian
        $this->forge->dropTable('soal_ujian', true);
    }
}
