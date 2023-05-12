<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreatePengawasTable extends Migration
{
    public function up()
    {
        //Pengawas
        $this->forge->addField([
            'id_pengawas'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment'      => true],
            'nip'                 => ['type' => 'varchar', 'constraint' => 18],
            'pengawas'            => ['type' => 'varchar', 'constraint' => 255],
            'created_at'          => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'          => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_pengawas', true);
        $this->forge->addUniqueKey('nip');

        $this->forge->createTable('pengawas', true);
    }

    public function down()
    {
        //Pengawas
        $this->forge->dropTable('pengawas', true);
    }
}
