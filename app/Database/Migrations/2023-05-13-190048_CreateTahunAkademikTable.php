<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class CreateTahunAkademikTable extends Migration
{
    public function up()
    {
        //Tahun Akademik
        $this->forge->addField([
            'id_tahun_akademik'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tahun'                 => ['type' => 'varchar', 'constraint' => 255],
            'semester'              => ['type' => 'enum', 'constraint' => ['Gasal', 'Genap']],
            'aktif'                 => ['type' => 'boolean'],
            'created_at'            => ['type' => 'TIMESTAMP', 'null' => true, 'default' => new RawSql('CURRENT_TIMESTAMP')],
            'updated_at'            => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id_tahun_akademik', true);

        $this->forge->createTable('tahun_akademik', true);
    }

    public function down()
    {
        //Tahun Akademik
        $this->forge->dropTable('tahun_akademik', true);
    }
}
