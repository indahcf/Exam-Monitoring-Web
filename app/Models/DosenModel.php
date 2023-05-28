<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'id_dosen';
    protected $allowedFields    = ['id_prodi', 'nidn', 'dosen'];
    protected $useTimestamps    = true;

    public function getDosen()
    {
        return $this->join('prodi', 'dosen.id_prodi=prodi.id_prodi')->findAll();
    }

    public function getDosenByKelas($id_kelas)
    {
        $id_dosen = $this->db->table('kelas')->where('id_kelas', $id_kelas)->Get()->getRow()->id_dosen;

        return $this->find($id_dosen);
    }
}
