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

$routes->get('/admin/user', 'Users::index');
$routes->get('/admin/user/create', 'Users::create');
$routes->post('/admin/user/save', 'Users::save');
$routes->get('/admin/user/edit/(:segment)', 'Users::edit/$1');
$routes->post('/admin/user/update/(:segment)', 'Users::update/$1');
$routes->delete('/admin/user/(:num)', 'Users::delete/$1');

$routes->get('/admin/matkul', 'Matkul::index');
$routes->get('/admin/matkul/create', 'Matkul::create');
$routes->post('/admin/matkul/save', 'Matkul::save');
$routes->get('/admin/matkul/edit/(:segment)', 'Matkul::edit/$1');
$routes->post('/admin/matkul/update/(:segment)', 'Matkul::update/$1');
$routes->delete('/admin/matkul/(:num)', 'Matkul::delete/$1');

$routes->get('/admin/prodi', 'Prodi::index');
$routes->get('/admin/prodi/create', 'Prodi::create');
$routes->post('/admin/prodi/save', 'Prodi::save');
$routes->get('/admin/prodi/edit/(:segment)', 'Prodi::edit/$1');
$routes->post('/admin/prodi/update/(:segment)', 'Prodi::update/$1');
$routes->delete('/admin/prodi/(:num)', 'Prodi::delete/$1');

$routes->get('/admin/dosen', 'Dosen::index');
$routes->get('/admin/dosen/create', 'Dosen::create');
$routes->post('/admin/dosen/save', 'Dosen::save');
$routes->get('/admin/dosen/edit/(:segment)', 'Dosen::edit/$1');
$routes->post('/admin/dosen/update/(:segment)', 'Dosen::update/$1');
$routes->delete('/admin/dosen/(:num)', 'Dosen::delete/$1');

$routes->get('/admin/kelas', 'Admin::kelas');

$routes->get('/admin/ruang_ujian', 'Admin::ruang_ujian');

$routes->get('/admin/pengawas', 'Admin::pengawas');

$routes->get('/admin/tahun_akademik', 'Admin::tahun_akademik');

$routes->get('/admin/jadwal_ujian', 'Admin::jadwal_ujian');

$routes->get('/admin/soal_ujian', 'Admin::soal_ujian');

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
