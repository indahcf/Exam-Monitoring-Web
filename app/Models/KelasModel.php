<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $allowedFields    = ['id_matkul', 'id_dosen', 'id_prodi', 'kelas', 'jumlah_mahasiswa'];

    public function getKelas($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'kelas.id_prodi=prodi.id_prodi')->findAll();
        }

        return $this->where(['kelas.id_kelas' => $id_kelas])->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'kelas.id_prodi=prodi.id_prodi')->first();
    }

    public function editKelas($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->findAll();
        }

        return $this->where(['kelas.id_kelas' => $id_kelas])->first();
    }
}
