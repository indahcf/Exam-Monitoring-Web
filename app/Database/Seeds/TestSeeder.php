<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->call('Users');
        $this->call('Prodi');
        $this->call('Matkul');
        $this->call('Dosen');
        $this->call('RuangUjian');
        $this->call('TahunAkademik');
        $this->call('Kelas');
        $this->call('Pengawas');
        $this->call('JadwalUjian');
        $this->call('JadwalRuang');
        $this->call('JadwalPengawas');
        $this->call('KehadiranPengawas');
    }
}
