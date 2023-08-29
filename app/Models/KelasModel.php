<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $allowedFields    = ['id_matkul', 'id_dosen', 'kelas', 'jumlah_mahasiswa'];
    protected $useTimestamps    = true;

    public function getKelas()
    {
        return $this->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'matkul.id_prodi=prodi.id_prodi')->orderBy('kelas.id_kelas', 'ASC')->findAll();
    }

    public function getKelasByProdi($id_prodi)
    {
        return $this->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->where('matkul.id_prodi', $id_prodi)->Get()->getResultArray();
    }

    public function getKelasByMatkul($id_matkul)
    {
        return $this->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->where('matkul.id_matkul', $id_matkul)->Get()->getResultArray();
    }
}
