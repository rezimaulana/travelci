<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
| 
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
| 
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'landing_page';
$route['404_override'] = 'page404';
$route['translate_uri_dashes'] = FALSE;
$route['registrasi'] = 'auth/registrasi';
$route['login-pelanggan'] = 'auth';
$route['login-keuangan'] = 'login_admin/keuangan';
$route['login-direktur'] = 'login_admin';
$route['login-tour'] = 'login_admin/tour';
$route['detail-paket/(:num)'] = 'pemesanan/detail_paket/$1';
$route['form-pemesanan/(:num)'] = 'pemesanan/form_pemesanan/$1';
$route['form-pembayaran'] = 'pembayaran/form_pembayaran';
$route['manage-pemesanan'] = 'manage_pemesanan';
$route['manage-pemesanan/(:num)/(:num)/(:num)'] = 'manage_pemesanan/persetujuan/$1/$2/$3';
$route['data-paket-wisata'] = 'data_paket_wisata';
$route['data-paket-wisata/tambah-paket'] = 'data_paket_wisata/tambah_paket';
$route['data-paket-wisata/edit-paket/(:num)'] = 'data_paket_wisata/edit_paket/$1';
$route['data-paket-wisata/tambah-fasilitas'] = 'data_paket_wisata/tambah_fasilitas';
$route['data-paket-wisata/(:num)'] = 'data_paket_wisata/hapus_paket/$1';
$route['data-pelanggan'] = 'data_pelanggan';
$route['data-pembayaran'] = 'data_pembayaran';
$route['data-pembayaran/(:num)/(:num)'] = 'data_pembayaran/proses_data_pembayaran/$1/$2';
$route['data-pembayaran/edit-pembayaran/(:num)'] = 'data_pembayaran/edit_pembayaran/$1';
$route['data-pembayaran/batal-pembayaran/(:num)'] = 'data_pembayaran/batal_pembayaran/$1';
$route['data-pembatalan/(:num)/(:num)'] = 'data_pembatalan/proses_pembatalan/$1/$2';
$route['data-pembatalan'] = 'data_pembatalan';
$route['my-profile'] = 'my_profile';
$route['my-profile/edit-profile'] = 'my_profile/edit_profile';
$route['cetak-kwitansi'] = 'pembayaran/cetak_kwitansi';
$route['manage-tour'] = 'manage_tour';
$route['manage-tour/(:num)'] = 'manage_tour/proses_manage_tour/$1';
$route['manage-pembatalan/(:num)/(:num)/(:num)'] = 'manage_pembatalan/proses_pembatalan/$1/$2/$3';
$route['manage-pembatalan'] = 'manage_pembatalan';
$route['list-batal-pesanan'] = 'pemesanan/list_batal';
$route['laporan-pemesanan'] = 'laporan_pemesanan';
$route['laporan-pemesanan/(:any)/(:any)'] = 'laporan_pemesanan/cetak_laporan/$1/$2';
$route['laporan-pembayaran'] = 'laporan_pembayaran';
$route['laporan-pembayaran/(:any)/(:any)'] = 'laporan_pembayaran/cetak_laporan/$1/$2';
$route['laporan-pembatalan'] = 'laporan_pembatalan';
$route['laporan-pembatalan/(:any)/(:any)'] = 'laporan_pembatalan/cetak_laporan/$1/$2';
$route['welcome'] = 'landing_page';
$route['about'] = 'landing_page/about';