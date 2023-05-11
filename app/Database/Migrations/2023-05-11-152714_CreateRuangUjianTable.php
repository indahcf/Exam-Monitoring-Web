<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateRuangUjianTable extends Migration
{
    public function up()
    {
        //Ruang Ujian
        $this->forge->addField([
            'id_ruang_ujian'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ruang_ujian'      => ['type' => 'varchar', 'constraint' => 25],
            'kapasitas'        => ['type' => 'int', 'constraint' => 11],
            'created_at'       => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'       => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_ruang_ujian', true);
        $this->forge->addUniqueKey('ruang_ujian');

        $this->forge->createTable('ruang_ujian', true);
    }

    public function down()
    {
        //Ruang Ujian
        $this->forge->dropTable('ruang_ujian', true);
    }
}
