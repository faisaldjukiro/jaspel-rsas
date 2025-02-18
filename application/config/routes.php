<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'LoginController';

$route['data-awal'] = 'JasaController';
$route['data-kosong'] = 'JasaController/getDatakosong';
$route['tindakan-ird'] = 'JasaController/getTindakanird';
$route['tindakan-poli'] = 'JasaController/getTindakanpoli';
$route['kasus-kosong'] = 'JasaController/getKasuskosong';
$route['layanan-kosong'] = 'JasaController/getLayanankosong';
$route['dpjp-kosong'] = 'JasaController/getDpjpkosong';



$route['rekap-data'] = 'RekapController/getRekap';
$route['rekap-dokter'] = 'RekapController/rekapDokter';
$route['rekap-semua'] = 'RekapController/rekapSemua';
$route['rincian-dokter-pasien/(:any)'] = 'RekapController/getRekapBynosep/$1';
$route['rincian-dokter-detail/(:any)'] = 'RekapController/getRekapBydokter/$1';

$route['export-data/(:any)'] = 'ExportController/exportRekapByDokter/$1';


//paramedis
$route['data-pegawai'] = 'PegawaiController/getPegawai';
$route['data-pegawai-tarik'] = 'PegawaiController/tarikDatapegawai';
$route['porsi-jasa-paramedis'] = 'PegawaiController/getPorsi';
$route['rekap-jasa-paramedis'] = 'PegawaiController/getRekapParamedis';
$route['rekap-jasa-paramedis-filter'] = 'PegawaiController/getRekapParamedisFilter';
$route['rekap-jasa-paramedis-filter/(:any)/(:any)'] = 'PegawaiController/getRekapParamedisFilter/$1/$2';

$route['rekap-jasa-paramedis-filter-export'] = 'ExportController/getRekapParamedisFilter';
$route['rekap-jasa-paramedis-filter-export/(:any)/(:any)'] = 'ExportController/getRekapParamedisFilter/$1/$2';


//hasil jasa
$route['jasa-dokter'] = 'HistoryController';
$route['rincian-dokter/(:any)/(:any)/(:any)'] = 'HistoryController/getRekapBydokter/$1/$2/$3';
$route['rincian-pasien-datail/(:any)/(:any)/(:any)'] = 'HistoryController/getRekapBynosep/$1/$2/$3';
$route['jasa-non-dokter'] = 'HistoryNonDokterController';

// $route['reset_password'] = 'LoginController/change_password';

//
$route['beranda'] = 'BerandaController/index';