<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $allowedFields    = ['id_matkul', 'id_dosen', 'id_prodi', 'kelas', 'jumlah_mahasiswa'];
    protected $useTimestamps    = true;

    public function getKelas($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'kelas.id_prodi=prodi.id_prodi')->findAll();
        }

        return $this->where(['kelas.id_kelas' => $id_kelas])->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->join('dosen', 'kelas.id_dosen=dosen.id_dosen')->join('prodi', 'kelas.id_prodi=prodi.id_prodi')->first();
    }

    public function allMatkul($id_prodi)
    {
        return $this->db->table('matkul')->where('id_prodi', $id_prodi)->Get()->getResultArray();
    }

    public function allDosen($id_prodi)
    {
        return $this->db->table('dosen')->where('id_prodi', $id_prodi)->Get()->getResultArray();
    }

    public function allKelas($id_prodi)
    {
        return $this->db->table('kelas')->where('kelas.id_prodi', $id_prodi)->join('matkul', 'kelas.id_matkul=matkul.id_matkul')->Get()->getResultArray();
    }
}
