<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\DosenModel;
use App\Models\KejadianModel;
use App\Models\PengawasModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalRuangModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;
use App\Models\JadwalPengawasModel;
use App\Models\KehadiranPesertaModel;
use App\Models\KehadiranPengawasModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class KehadiranPeserta extends BaseController
{
    protected $tahun_akademikModel;
    protected $kehadiran_pengawasModel;
    protected $kehadiran_pesertaModel;
    protected $jadwal_ujianModel;
    protected $ruang_ujianModel;
    protected $jadwal_ruangModel;
    protected $jadwal_pengawas_model;
    protected $dosenModel;
    protected $pengawasModel;
    protected $kejadianModel;
    protected $db;

    public function __construct()
    {
        $this->kehadiran_pengawasModel = new KehadiranPengawasModel();
        $this->kehadiran_pesertaModel = new KehadiranPesertaModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->jadwal_ruangModel = new JadwalRuangModel();
        $this->jadwal_pengawas_model = new JadwalPengawasModel();
        $this->dosenModel = new DosenModel();
        $this->pengawasModel = new PengawasModel();
        $this->kejadianModel = new KejadianModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (count(array_intersect(user()->roles, ['Admin', 'Ketua Panitia'])) > 0) {
            $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
            $kehadiran_peserta_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

            $filter = $this->request->getVar('filter');
            $kehadiran_peserta = [];
            if ($kehadiran_peserta_terakhir) {
                $periode_ujian_aktif = $kehadiran_peserta_terakhir[0]['periode_ujian'];
                $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
                // dd($filter);
                $id_tahun_akademik = explode("_", $filter)[0];
                $periode_ujian = explode("_", $filter)[1];
                $kehadiran_peserta = $this->kehadiran_pesertaModel->filterKehadiranPeserta($id_tahun_akademik, $periode_ujian);
            }
            // dd($kehadiran_peserta);

            $jenis_kejadian = ['Menyontek', 'Ke Toilet/Tindakan Mencurigakan', 'Tidak Tercantum Di Absen', 'Lain-lain'];

            $data = [
                'title' => 'Data Kehadiran Peserta',
                'kehadiran_peserta' => $kehadiran_peserta,
                'tahun_akademik' => $this->tahun_akademikModel->findAll(),
                'filter' => $filter,
                'jenis_kejadian' => $jenis_kejadian
            ];
        } else if (count(array_intersect(user()->roles, ['Pengawas', 'Koordinator'])) > 0) {
            $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
            $kehadiran_peserta_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();

            $filter = $this->request->getVar('filter');
            $kehadiran_peserta = [];
            if ($kehadiran_peserta_terakhir) {
                $periode_ujian_aktif = $kehadiran_peserta_terakhir[0]['periode_ujian'];
                $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
                // dd($filter);
                $id_tahun_akademik = explode("_", $filter)[0];
                $periode_ujian = explode("_", $filter)[1];
                $kehadiran_peserta = $this->kehadiran_pesertaModel->filterKehadiranPesertaPengawas($id_tahun_akademik, $periode_ujian);
            }

            $jenis_kejadian = ['Menyontek', 'Ke Toilet/Tindakan Mencurigakan', 'Tidak Tercantum Di Absen', 'Lain-lain'];

            $data = [
                'title' => 'Data Kehadiran Peserta',
                'kehadiran_peserta' => $kehadiran_peserta,
                'jenis_kejadian' => $jenis_kejadian
            ];
        }

        return view('admin/kehadiran_peserta/index', $data);
    }

    public function rekap($id_jadwal_ujian, $id_jadwal_ruang)
    {
        $jadwal_ujian = $this->jadwal_ujianModel
            ->select('jadwal_ujian.*, kelas.*, matkul.*, prodi.*, dosen.*')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->find($id_jadwal_ujian);

        $ruang_ujian = $this->ruang_ujianModel
            ->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->where('jadwal_ruang.id_jadwal_ruang =', $id_jadwal_ruang)
            ->get()
            ->getRowArray();

        $jumlah_peserta = $this->jadwal_ruangModel->where('id_jadwal_ruang', $id_jadwal_ruang)->get()->getRowArray();

        $kehadiran_peserta = $this->kehadiran_pesertaModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();

        $pengawas = $this->kehadiran_pengawasModel
            ->select('pengawas1.pengawas as nama_pengawas1, pengawas2.pengawas as nama_pengawas2')
            ->join('pengawas as pengawas1', 'pengawas1.id_pengawas=kehadiran_pengawas.pengawas_1', 'left')
            ->join('pengawas as pengawas2', 'pengawas2.id_pengawas=kehadiran_pengawas.pengawas_2', 'left')
            ->where('id_jadwal_ruang', $id_jadwal_ruang)
            ->get()
            ->getRowArray();
        // dd($pengawas);
        $pengawas3 = $this->dosenModel->join('kelas', 'kelas.id_dosen=dosen.id_dosen')->join('jadwal_ujian', 'jadwal_ujian.id_kelas=kelas.id_kelas')->where('jadwal_ujian.id_jadwal_ujian =', $id_jadwal_ujian)->get()->getRowArray();

        $pengawas3_hadir = $this->kehadiran_pengawasModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();
        $kejadian = $this->kejadianModel->where('id_jadwal_ruang', $id_jadwal_ruang)->findAll();

        $data = [
            'title' => 'Rekap Data Kehadiran Peserta',
            'jadwal_ujian' => $jadwal_ujian,
            'ruang_ujian' => $ruang_ujian['ruang_ujian'],
            'jumlah_peserta' => $jumlah_peserta['jumlah_peserta'],
            'id_jadwal_ujian' => $id_jadwal_ujian,
            'id_jadwal_ruang' => $id_jadwal_ruang,
            'kehadiran_peserta' => $kehadiran_peserta,
            'pengawas' => $pengawas,
            'pengawas3' => $pengawas3,
            'kejadian' => $kejadian != NULL ? $kejadian : [],
            'pengawas3_hadir' => $pengawas3_hadir != NULL ? $pengawas3_hadir['pengawas_3'] : ''
        ];
        // dd($data['pengawas']);
        return view('admin/kehadiran_peserta/rekap', $data);
    }

    public function save()
    {
        // dd($this->request->getPost());
        if (!$this->validate([
            'jumlah_lju' => [
                'rules' => 'required',
                'label' => 'Jumlah LJU',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $id_jadwal_ruang = $this->request->getVar('id_jadwal_ruang');
        $kehadiran_peserta = $this->kehadiran_pesertaModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();
        $kehadiran_pengawas = $this->kehadiran_pengawasModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();
        $kejadian = $this->kejadianModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();

        try {
            if ($kehadiran_pengawas) {
                $this->kehadiran_pengawasModel->save([
                    'id_kehadiran_pengawas' => $kehadiran_pengawas['id_kehadiran_pengawas'],
                    'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                    'pengawas_3' => $this->request->getVar('pengawas3') == '' ? NULL : $this->request->getVar('pengawas3')
                ]);
            }

            if ($kehadiran_peserta) {
                $this->kehadiran_pesertaModel->save([
                    'id_kehadiran_peserta' => $kehadiran_peserta['id_kehadiran_peserta'],
                    'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                    'total_hadir' => $this->request->getVar('total_hadir'),
                    'sakit' => $this->request->getVar('sakit'),
                    'nim_sakit' => json_encode($this->request->getVar('nim_sakit')),
                    'izin' => $this->request->getVar('izin'),
                    'nim_izin' => json_encode($this->request->getVar('nim_izin')),
                    'tanpa_ket' => $this->request->getVar('tanpa_ket'),
                    'nim_tanpa_ket' => json_encode($this->request->getVar('nim_tanpa_ket')),
                    'tidak_memenuhi_syarat' => $this->request->getVar('tidak_memenuhi_syarat'),
                    'nim_tidak_memenuhi_syarat' => json_encode($this->request->getVar('nim_tidak_memenuhi_syarat')),
                    'presensi_kurang' => $this->request->getVar('presensi_kurang'),
                    'nim_presensi_kurang' => json_encode($this->request->getVar('nim_presensi_kurang')),
                    'jumlah_lju' => $this->request->getVar('jumlah_lju')
                ]);

                session()->setFlashdata('success', 'Data Berhasil Diubah');
            } else {
                $this->kehadiran_pesertaModel->save([
                    'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                    'total_hadir' => $this->request->getVar('total_hadir'),
                    'sakit' => $this->request->getVar('sakit'),
                    'nim_sakit' => json_encode($this->request->getVar('nim_sakit')),
                    'izin' => $this->request->getVar('izin'),
                    'nim_izin' => json_encode($this->request->getVar('nim_izin')),
                    'tanpa_ket' => $this->request->getVar('tanpa_ket'),
                    'nim_tanpa_ket' => json_encode($this->request->getVar('nim_tanpa_ket')),
                    'tidak_memenuhi_syarat' => $this->request->getVar('tidak_memenuhi_syarat'),
                    'nim_tidak_memenuhi_syarat' => json_encode($this->request->getVar('nim_tidak_memenuhi_syarat')),
                    'presensi_kurang' => $this->request->getVar('presensi_kurang'),
                    'nim_presensi_kurang' => json_encode($this->request->getVar('nim_presensi_kurang')),
                    'jumlah_lju' => $this->request->getVar('jumlah_lju')
                ]);

                session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            }

            $data_kejadian = $this->request->getVar('kejadian');

            if ($kejadian) {
                $this->kejadianModel->where('id_jadwal_ruang', $this->request->getVar('id_jadwal_ruang'))->delete();
            }

            if ($data_kejadian) {
                foreach ($data_kejadian as $data) {
                    $this->kejadianModel->save([
                        'id_jadwal_ruang' => $this->request->getVar('id_jadwal_ruang'),
                        'nim' => $data['nim'],
                        'nama_mhs' => $data['nama_mhs'],
                        'jenis_kejadian' => $data['jenis_kejadian']
                    ]);
                }
            }
        } catch (DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/kehadiran_peserta');
    }

    public function export($id_jadwal_ujian, $id_jadwal_ruang)
    {
        $tahun_akademik_aktif = $this->tahun_akademikModel->getAktif()['id_tahun_akademik'];
        $kehadiran_peserta_terakhir = $this->jadwal_ujianModel->orderBy('tanggal', 'DESC')->findAll();
        $periode_ujian_aktif = $kehadiran_peserta_terakhir[0]['periode_ujian'];
        $filter = $this->request->getVar('filter') ?: $tahun_akademik_aktif . "_" . $periode_ujian_aktif;
        $id_tahun_akademik = explode("_", $filter)[0];
        $periode_ujian = explode("_", $filter)[1];
        $kehadiran_peserta_label = $this->kehadiran_pesertaModel->filterKehadiranPeserta($id_tahun_akademik, $periode_ujian);

        $label = $periode_ujian . ' ' . $kehadiran_peserta_label[0]['semester'] . ' Tahun Akademik ' . $kehadiran_peserta_label[0]['tahun_akademik'];

        $jadwal_ujian = $this->jadwal_ujianModel
            ->select('jadwal_ujian.*, kelas.*, matkul.*, prodi.*, dosen.*')
            ->join('kelas', 'jadwal_ujian.id_kelas=kelas.id_kelas')
            ->join('matkul', 'kelas.id_matkul=matkul.id_matkul')
            ->join('prodi', 'matkul.id_prodi=prodi.id_prodi')
            ->join('dosen', 'kelas.id_dosen=dosen.id_dosen')
            ->find($id_jadwal_ujian);

        $ruang_ujian = $this->ruang_ujianModel
            ->join('jadwal_ruang', 'jadwal_ruang.id_ruang_ujian=ruang_ujian.id_ruang_ujian')
            ->where('jadwal_ruang.id_jadwal_ruang =', $id_jadwal_ruang)
            ->get()
            ->getRowArray();

        $pengawas = $this->kehadiran_pengawasModel
            ->select('pengawas1.pengawas as nama_pengawas1, pengawas2.pengawas as nama_pengawas2')
            ->join('pengawas as pengawas1', 'pengawas1.id_pengawas=kehadiran_pengawas.pengawas_1', 'left')
            ->join('pengawas as pengawas2', 'pengawas2.id_pengawas=kehadiran_pengawas.pengawas_2', 'left')
            ->where('id_jadwal_ruang', $id_jadwal_ruang)
            ->get()
            ->getRowArray();

        $pengawas3 = $this->dosenModel->join('kelas', 'kelas.id_dosen=dosen.id_dosen')->join('jadwal_ujian', 'jadwal_ujian.id_kelas=kelas.id_kelas')->where('jadwal_ujian.id_jadwal_ujian =', $id_jadwal_ujian)->get()->getRowArray();

        $kehadiran_peserta = $this->kehadiran_pesertaModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();

        $pengawas3_hadir = $this->kehadiran_pengawasModel->where('id_jadwal_ruang', $id_jadwal_ruang)->first();

        $kejadian = $this->kejadianModel->where('id_jadwal_ruang', $id_jadwal_ruang)->orderBy('nim', 'ASC')->findAll();

        $jenis_kejadian = ['Menyontek', 'Ke Toilet/Tindakan Mencurigakan', 'Tidak Tercantum Di Absen', 'Lain-lain'];

        $data = [
            'label' => $label,
            'jadwal_ujian' => $jadwal_ujian,
            'ruang_ujian' => $ruang_ujian['ruang_ujian'],
            'pengawas' => $pengawas,
            'pengawas3' => $pengawas3,
            'kehadiran_peserta' => $kehadiran_peserta,
            'pengawas3_hadir' => $pengawas3_hadir != NULL ? $pengawas3_hadir['pengawas_3'] : '',
            'kejadian' => $kejadian,
            'jenis_kejadian' => $jenis_kejadian
        ];
        // dd($data['kejadian']);
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml(view('admin/kehadiran_peserta/export', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('Berita Acara Ujian.pdf', array("Attachment" => false));
    }
}
