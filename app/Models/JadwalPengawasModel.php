<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPengawasModel extends Model
{
    protected $table            = 'jadwal_pengawas';
    protected $primaryKey       = 'id_jadwal_pengawas';
    protected $allowedFields    = ['id_jadwal_ruang', 'id_pengawas'];
    protected $useTimestamps    = true;
}
