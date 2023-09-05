<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('setting/ubah_password', 'Setting::ubah_password');
$routes->post('setting/update_password', 'Setting::update_password');

$routes->group('admin', ['filter' => 'auth:Admin'], function ($routes) {

    $routes->get('user', 'Users::index');
    $routes->get('user/create', 'Users::create');
    $routes->post('user/save', 'Users::save');
    $routes->get('user/edit/(:segment)', 'Users::edit/$1');
    $routes->post('user/update/(:segment)', 'Users::update/$1');
    $routes->delete('user/(:num)', 'Users::delete/$1');
    $routes->get('user/ubah_password/(:segment)', 'Users::ubah_password/$1');
    $routes->post('user/update_password/(:segment)', 'Users::update_password/$1');

    $routes->get('matkul', 'Matkul::index');
    $routes->get('matkul/create', 'Matkul::create');
    $routes->post('matkul/save', 'Matkul::save');
    $routes->get('matkul/edit/(:segment)', 'Matkul::edit/$1');
    $routes->post('matkul/update/(:segment)', 'Matkul::update/$1');
    $routes->delete('matkul/(:num)', 'Matkul::delete/$1');
    $routes->post('matkul/simpanExcel', 'Matkul::simpanExcel');

    $routes->get('prodi', 'Prodi::index');
    $routes->get('prodi/create', 'Prodi::create');
    $routes->post('prodi/save', 'Prodi::save');
    $routes->get('prodi/edit/(:segment)', 'Prodi::edit/$1');
    $routes->post('prodi/update/(:segment)', 'Prodi::update/$1');
    $routes->delete('prodi/(:num)', 'Prodi::delete/$1');

    $routes->get('dosen', 'Dosen::index');
    $routes->get('dosen/create', 'Dosen::create');
    $routes->post('dosen/save', 'Dosen::save');
    $routes->get('dosen/edit/(:segment)', 'Dosen::edit/$1');
    $routes->post('dosen/update/(:segment)', 'Dosen::update/$1');
    $routes->delete('dosen/(:num)', 'Dosen::delete/$1');
    $routes->post('dosen/simpanExcel', 'Dosen::simpanExcel');

    $routes->get('kelas', 'Kelas::index');
    $routes->get('kelas/create', 'Kelas::create');
    $routes->post('kelas/save', 'Kelas::save');
    $routes->get('kelas/edit/(:segment)', 'Kelas::edit/$1');
    $routes->post('kelas/update/(:segment)', 'Kelas::update/$1');
    $routes->delete('kelas/(:num)', 'Kelas::delete/$1');
    $routes->post('kelas/simpanExcel', 'Kelas::simpanExcel');

    $routes->get('ruang_ujian', 'RuangUjian::index');
    $routes->get('ruang_ujian/create', 'RuangUjian::create');
    $routes->post('ruang_ujian/save', 'RuangUjian::save');
    $routes->get('ruang_ujian/edit/(:segment)', 'RuangUjian::edit/$1');
    $routes->post('ruang_ujian/update/(:segment)', 'RuangUjian::update/$1');
    $routes->delete('ruang_ujian/(:num)', 'RuangUjian::delete/$1');
    $routes->post('ruang_ujian/simpanExcel', 'RuangUjian::simpanExcel');

    $routes->get('pengawas_ujian', 'Pengawas::index');
    $routes->get('pengawas_ujian/create', 'Pengawas::create');
    $routes->post('pengawas_ujian/save', 'Pengawas::save');
    $routes->get('pengawas_ujian/edit/(:segment)', 'Pengawas::edit/$1');
    $routes->post('pengawas_ujian/update/(:segment)', 'Pengawas::update/$1');
    $routes->delete('pengawas_ujian/(:num)', 'Pengawas::delete/$1');

    $routes->get('tahun_akademik', 'TahunAkademik::index');
    $routes->get('tahun_akademik/create', 'TahunAkademik::create');
    $routes->post('tahun_akademik/save', 'TahunAkademik::save');
    $routes->get('tahun_akademik/edit/(:segment)', 'TahunAkademik::edit/$1');
    $routes->post('tahun_akademik/update/(:segment)', 'TahunAkademik::update/$1');
    $routes->delete('tahun_akademik/(:num)', 'TahunAkademik::delete/$1');
    $routes->post('tahun_akademik/update_status/(:segment)', 'TahunAkademik::update_status/$1');

    $routes->get('jadwal_ujian', 'JadwalUjian::index');
    $routes->get('jadwal_ujian/create', 'JadwalUjian::create');
    $routes->post('jadwal_ujian/save', 'JadwalUjian::save');
    $routes->get('jadwal_ujian/edit/(:segment)', 'JadwalUjian::edit/$1');
    $routes->post('jadwal_ujian/update/(:segment)', 'JadwalUjian::update/$1');
    $routes->delete('jadwal_ujian/(:num)', 'JadwalUjian::delete/$1');
    $routes->post('jadwal_ujian/simpanExcel', 'JadwalUjian::simpanExcel');
    $routes->get('jadwal_ujian/export_mhs', 'JadwalUjian::export_mhs');
    $routes->get('jadwal_ujian/export_panitia', 'JadwalUjian::export_panitia');

    $routes->get('soal_ujian', 'SoalUjian::index', ['filter' => 'auth:Admin,Dosen']);
    $routes->get('soal_ujian/create', 'SoalUjian::create', ['filter' => 'auth:Admin,Dosen'], ['filter' => 'auth:Admin,Dosen']);
    $routes->post('soal_ujian/save', 'SoalUjian::save', ['filter' => 'auth:Admin,Dosen']);
    $routes->get('soal_ujian/edit/(:segment)', 'SoalUjian::edit/$1', ['filter' => 'auth:Admin,Dosen']);
    $routes->post('soal_ujian/update/(:segment)', 'SoalUjian::update/$1', ['filter' => 'auth:Admin,Dosen']);
    $routes->delete('soal_ujian/(:num)', 'SoalUjian::delete/$1', ['filter' => 'auth:Admin,Dosen']);
    $routes->post('soal_ujian/lihat_soal/(:segment)', 'SoalUjian::lihat_soal/$1', ['filter' => 'auth:Admin,Dosen,Gugus Kendali Mutu,Pencetak Soal']);
    $routes->get('soal_ujian/hasil_review/(:segment)', 'SoalUjian::hasil_review/$1', ['filter' => 'auth:Admin,Dosen']);

    $routes->get('review_soal', 'SoalUjian::view_review_soal_ujian', ['filter' => 'auth:Admin,Gugus Kendali Mutu']);
    $routes->get('review_soal/review/(:segment)', 'SoalUjian::review/$1', ['filter' => 'auth:Admin,Gugus Kendali Mutu']);
    $routes->post('review_soal/update_review/(:segment)', 'SoalUjian::update_review/$1', ['filter' => 'auth:Admin,Gugus Kendali Mutu']);

    $routes->get('print_soal', 'SoalUjian::view_cetak_soal_ujian', ['filter' => 'auth:Admin,Pencetak Soal']);
    $routes->get('soal_ujian/cetak_soal/(:segment)', 'SoalUjian::cetak_soal/$1', ['filter' => 'auth:Admin,Pencetak Soal']);

    $routes->get('kehadiran_pengawas', 'KehadiranPengawas::index', ['filter' => 'auth:Admin,Koordinator']);
    $routes->get('kehadiran_pengawas/rekap/(:segment)/(:segment)', 'KehadiranPengawas::rekap/$1/$2', ['filter' => 'auth:Admin,Koordinator']);
    $routes->post('kehadiran_pengawas/save/(:segment)/(:segment)', 'KehadiranPengawas::save/$1/$2', ['filter' => 'auth:Admin,Koordinator']);
    $routes->post('kehadiran_pengawas/update/(:segment)', 'KehadiranPengawas::update/$1', ['filter' => 'auth:Admin,Koordinator']);

    $routes->get('kehadiran_peserta', 'KehadiranPeserta::index', ['filter' => 'auth:Admin,Pengawas,Koordinator,Ketua Panitia']);
    $routes->get('kehadiran_peserta/rekap/(:segment)/(:segment)', 'KehadiranPeserta::rekap/$1/$2', ['filter' => 'auth:Admin,Pengawas']);
    $routes->post('kehadiran_peserta/save/(:segment)/(:segment)', 'KehadiranPeserta::save/$1/$2', ['filter' => 'auth:Admin,Pengawas']);
    $routes->get('kehadiran_peserta/export/(:segment)/(:segment)', 'KehadiranPeserta::export/$1/$2', ['filter' => 'auth:Admin,Pengawas,Koordinator,Ketua Panitia']);

    $routes->get('distribusi_hasil_ujian', 'DistribusiHasilUjian::index', ['filter' => 'auth:Admin,Dosen,Pendistribusi Hasil Ujian']);
    $routes->get('distribusi_hasil_ujian/edit/(:segment)', 'DistribusiHasilUjian::edit/$1', ['filter' => 'auth:Admin,Pendistribusi Hasil Ujian']);
    $routes->post('distribusi_hasil_ujian/update/(:segment)', 'DistribusiHasilUjian::update/$1', ['filter' => 'auth:Admin,Pendistribusi Hasil Ujian']);
    $routes->get('distribusi_hasil_ujian/detail/(:segment)', 'DistribusiHasilUjian::detail/$1', ['filter' => 'auth:Admin,Dosen']);
    $routes->post('distribusi_hasil_ujian/update_status_diterima/(:segment)', 'DistribusiHasilUjian::update_status_diterima/$1', ['filter' => 'auth:Admin,Dosen']);

    $routes->get('pencetak_soal', 'PencetakSoal::index');
    $routes->get('pencetak_soal/create', 'PencetakSoal::create');
    $routes->post('pencetak_soal/save', 'PencetakSoal::save');
    $routes->get('pencetak_soal/edit/(:segment)', 'PencetakSoal::edit/$1');
    $routes->post('pencetak_soal/update/(:segment)', 'PencetakSoal::update/$1');
    $routes->delete('pencetak_soal/(:num)', 'PencetakSoal::delete/$1');
});

// API 
$routes->get('api/dosen', 'Dosen::json');
$routes->get('api/dosen/(:num)', 'Dosen::json/$1');
$routes->get('api/matkul', 'Matkul::json');
$routes->get('api/matkul/(:num)', 'Matkul::json/$1');
$routes->get('api/kelas', 'Kelas::json');
$routes->get('api/kelas/(:num)', 'Kelas::json/$1');
$routes->get('api/ruang_ujian', 'RuangUjian::json');
$routes->get('api/ruang_ujian/(:num)', 'RuangUjian::json/$1');
$routes->get('api/pengawas', 'Pengawas::json');
$routes->get('api/pengawas/(:num)', 'Pengawas::json/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
