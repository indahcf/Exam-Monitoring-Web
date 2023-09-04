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
        return $this->db->table('users')
            // ->select('*')
            ->where('user_role.id_role', 4)
            ->join('pencetak_soal', 'users.id = pencetak_soal.id_user', 'left')
            ->join('user_role', 'users.id=user_role.id_user')
            ->join('pengawas', 'pengawas.id_user = users.id', 'left')
            ->join('prodi', 'pencetak_soal.id_prodi = prodi.id_prodi', 'left')
            ->orderBy('pencetak_soal.id_pencetak_soal', 'ASC')
            ->get()
            ->getResultArray();
    }
}
