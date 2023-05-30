<?php

namespace App\Models;

use CodeIgniter\Model;

class PengawasModel extends Model
{
    protected $table            = 'pengawas';
    protected $primaryKey       = 'id_pengawas';
    protected $allowedFields    = ['nip', 'pengawas'];
    protected $useTimestamps    = true;
}
