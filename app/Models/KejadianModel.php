<?php

namespace App\Models;

use CodeIgniter\Model;

class KejadianModel extends Model
{
    protected $table            = 'kejadian';
    protected $primaryKey       = 'id_kejadian';
    protected $allowedFields    = ['id_jadwal_ruang', 'id_kehadiran_peserta', 'id_kehadiran_pengawas', 'nim', 'nama_mhs', 'jenis_kejadian'];
    protected $useTimestamps    = true;
}
