<?php

namespace App\Models;

use CodeIgniter\Model;

class KehadiranPengawasModel extends Model
{
    protected $table            = 'kehadiran_pengawas';
    protected $primaryKey       = 'id_kehadiran_pengawas';
    protected $allowedFields    = ['id_jadwal_ruang', 'pengawas_1', 'pengawas_2', 'pengawas_3'];
    protected $useTimestamps    = true;
}
