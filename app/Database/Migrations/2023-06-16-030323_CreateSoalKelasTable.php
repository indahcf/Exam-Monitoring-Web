<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateSoalKelasTable extends Migration
{
    public function up()
    {
        //Soal Kelas
        $this->forge->addField([
            'id_soal_kelas'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_soal_ujian'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_kelas'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_soal_kelas', true);
        $this->forge->addForeignKey('id_soal_ujian', 'soal_ujian', 'id_soal_ujian', 'CASCADE', 'CASCADE', 'fk_soal_ujian');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas');

        $this->forge->createTable('soal_kelas', true);
    }

    public function down()
    {
        //Soal Kelas
        $this->forge->dropTable('soal_kelas', true);
    }
}
