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
            'soal_ujian'            => ['type' => 'varchar', 'constraint' => 1000],
            'status'                => ['type' => 'enum', 'constraint' => ['Menunggu Direview', 'Tolak GKM', 'Diterima', 'Dicetak', 'Distribusi Hasil Ujian'], 'default' => 'Menunggu Direview'],
            'periode_ujian'         => ['type' => 'enum', 'constraint' => ['UTS', 'UAS']],
            'bentuk_soal'           => ['type' => 'enum', 'constraint' => ['Uraian', 'Pilihan Ganda', 'Uraian dan Pilihan Ganda']],
            'metode'                => ['type' => 'enum', 'constraint' => ['Luring', 'Daring']],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_soal_ujian', true);
        $this->forge->addForeignKey('id_tahun_akademik', 'tahun_akademik', 'id_tahun_akademik');

        $this->forge->createTable('soal_ujian', true);
    }

    public function down()
    {
        //Soal Ujian
        $this->forge->dropTable('soal_ujian', true);
    }
}
