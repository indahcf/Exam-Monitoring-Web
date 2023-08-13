<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateRoleTable extends Migration
{
    public function up()
    {
        //Role
        $this->forge->addField([
            'id_role'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'role'           => ['type' => 'varchar', 'constraint' => 255],
            'created_at'        => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_role', true);

        $this->forge->createTable('role', true);
    }

    public function down()
    {
        //Role
        $this->forge->dropTable('role', true);
    }
}
