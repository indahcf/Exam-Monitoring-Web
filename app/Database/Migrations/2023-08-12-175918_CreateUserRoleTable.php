<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateUserRoleTable extends Migration
{
    public function up()
    {
        //User Role
        $this->forge->addField([
            'id_user_role'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_user'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'id_role'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at'        => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'        => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_user_role', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_role', 'role', 'id_role');

        $this->forge->createTable('user_role', true);
    }

    public function down()
    {
        //User Role
        $this->forge->dropTable('user_role', true);
    }
}
