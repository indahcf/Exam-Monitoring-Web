<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreatePencetakSoalTable extends Migration
{
    public function up()
    {
        //Pencetak Soal
        $this->forge->addField([
            'id_pencetak_soal'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_user'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_prodi'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'created_at'        => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_pencetak_soal', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');

        $this->forge->createTable('pencetak_soal', true);
    }

    public function down()
    {
        //Pencetak Soal
        $this->forge->dropTable('pencetak_soal', true);
    }
}
