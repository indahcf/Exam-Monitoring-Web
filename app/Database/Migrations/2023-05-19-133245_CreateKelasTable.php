<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateKelasTable extends Migration
{
    public function up()
    {
        //Kelas
        $this->forge->addField([
            'id_kelas'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment'    => true],
            'id_matkul'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_dosen'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_prodi'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'kelas'             => ['type' => 'varchar', 'constraint' => 1],
            'jumlah_mahasiswa'  => ['type' => 'int', 'constraint' => 11],
            'created_at'        => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_kelas', true);
        $this->forge->addForeignKey('id_matkul', 'matkul', 'id_matkul');
        $this->forge->addForeignKey('id_dosen', 'dosen', 'id_dosen');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');

        $this->forge->createTable('kelas', true);
    }

    public function down()
    {
        //Kelas
        $this->forge->dropTable('kelas', true);
    }
}
