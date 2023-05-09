<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateMatkulTable extends Migration
{
    public function up()
    {
        //Matkul
        $this->forge->addField([
            'id_matkul'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_prodi'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'kode_matkul'      => ['type' => 'varchar', 'constraint' => 255],
            'matkul'           => ['type' => 'varchar', 'constraint' => 255],
            'jumlah_sks'       => ['type' => 'int', 'constraint' => 11],
            'semester'         => ['type' => 'enum', 'constraint' => ['Gasal', 'Genap']],
            'created_at'       => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'       => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_matkul', true);
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi');

        $this->forge->createTable('matkul', true);
    }

    public function down()
    {
        //Matkul
        $this->forge->dropTable('matkul', true);
    }
}
