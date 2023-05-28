<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAkademikModel extends Model
{
    protected $table            = 'tahun_akademik';
    protected $primaryKey       = 'id_tahun_akademik';
    protected $allowedFields    = ['tahun', 'semester', 'status'];
    protected $useTimestamps    = true;

    public function getAktif()
    {
        return $this->where('status', true)->first();
    }
}
