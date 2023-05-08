<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateProdiTable extends Migration
{
    public function up()
    {
        //Prodi
        $this->forge->addField([
            'id_prodi'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'prodi'            => ['type' => 'varchar', 'constraint' => 255],
            'created_at'       => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'       => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_prodi', true);
        $this->forge->addUniqueKey('prodi');

        $this->forge->createTable('prodi', true);
    }

    public function down()
    {
        //Prodi
        $this->forge->dropTable('prodi', true);
    }
}
