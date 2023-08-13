<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateDosenTable extends Migration
{
    public function up()
    {
        //Dosen
        $this->forge->addField([
            'id_dosen'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_user'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'id_prodi'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'nidn'              => ['type' => 'varchar', 'constraint' => 10],
            'dosen'             => ['type' => 'varchar', 'constraint' => 255],
            'created_at'        => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_dosen', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');

        $this->forge->createTable('dosen', true);
    }

    public function down()
    {
        //Dosen
        $this->forge->dropTable('dosen', true);
    }
}
