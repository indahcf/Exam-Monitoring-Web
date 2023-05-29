<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAkademikModel extends Model
{
    protected $table            = 'tahun_akademik';
    protected $primaryKey       = 'id_tahun_akademik';
    protected $allowedFields    = ['tahun_akademik', 'semester', 'status'];
    protected $useTimestamps    = true;

    public function getAktif()
    {
        return $this->where('status', true)->first();
    }

    public function setAktif($id)
    {
        $builder = $this->db->table('tahun_akademik');
        $builder->set('status', 0);
        $builder->update();

        return $this->save([
            'id_tahun_akademik' => $id,
            'status' => 1
        ]);
    }
}
