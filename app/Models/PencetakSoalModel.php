<?php

namespace App\Models;

use CodeIgniter\Model;

class PencetakSoalModel extends Model
{
    protected $table            = 'pencetak_soal';
    protected $primaryKey       = 'id_pencetak_soal';
    protected $allowedFields    = ['id_user', 'id_prodi'];
    protected $useTimestamps    = true;

    public function getPencetakSoal()
    {
        return $this->db->table('pencetak_soal')
            ->select('*')
            ->join('users', 'users.id = pencetak_soal.id_user')
            ->join('pengawas', 'pengawas.id_user = users.id')
            ->join('prodi', 'pencetak_soal.id_prodi = prodi.id_prodi')
            ->get()
            ->getResultArray();
    }
}
