<?php

use App\Grafik;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$mulai = 2005;
	$tahun = [];
	while ( $mulai < date('Y')) {
		$tahun[] = $mulai++;
	}

	$grafik = Grafik::get();
	$tahun = Grafik::groupBy('tahun')->pluck('tahun');

	$map = $grafik->mapToGroups(function ($item, $key) {
		return [ $item['kategori'] => $item['siswa']];
	});

	$map2 = $grafik->mapToGroups(function ($item, $key) {
		return [ $item['kategori'] => $item['siswa_lulus']];
	});
	$dataSiswa = [];
	$dataSiswaLulus = [];

	foreach ($map as $key => $value) {
		if($key == 'polri'){
			$colour = '#787878';
		}elseif($key == 'tni'){
			$colour = '#007d09';
		}elseif($key == 'cpns'){
			$colour = '#00089c';
		}elseif($key == 'bumn'){
			$colour = '#d0295f';
		}elseif($key == 'sekolah-dinas'){
			$colour = '#b38e85';
		}
		$dataSiswa[] = [ 
			'label' => $key , 
			'data' => $value->toArray(), 
			'backgroundColor' => $colour, 
			'borderWidth'=> 1 ,
			'borderColor'=> '#777' ,
			'hoverBorderWidth'=> '3',
			'hoverBorderColor'=> '#000',
		];
	}

	foreach ($map2 as $key => $value) {
		if($key == 'polri'){
			$colour = '#787878';
		}elseif($key == 'tni'){
			$colour = '#007d09';
		}elseif($key == 'cpns'){
			$colour = '#00089c';
		}elseif($key == 'bumn'){
			$colour = '#d0295f';
		}elseif($key == 'sekolah-dinas'){
			$colour = '#b38e85';
		}
		$dataSiswaLulus[] = [ 
			'label' => $key , 
			'data' => $value->toArray(), 
			'backgroundColor' => $colour, 
			'borderWidth'=> 1 ,
			'borderColor'=> '#777' ,
			'hoverBorderWidth'=> '3',
			'hoverBorderColor'=> '#000',
		];
	}

	return view('index')->with('data', json_encode($dataSiswa))->with('tahun', json_encode($tahun))->with('data2', json_encode($dataSiswaLulus));
});

Route::get('/chart', function () {
	$mulai = 2005;
	$tahun = [];
	while ( $mulai < date('Y')) {
		$tahun[] = $mulai++;
	}

	$grafik = Grafik::get();
	$tahun = Grafik::groupBy('tahun')->pluck('tahun');

	$map = $grafik->mapToGroups(function ($item, $key) {
		return [ $item['kategori'] => $item['siswa']];
	});
	$dataSiswa = [];

	foreach ($map as $key => $value) {
		if($key == 'polri'){
			$colour = '#787878';
		}elseif($key == 'tni'){
			$colour = '#007d09';
		}elseif($key == 'cpns'){
			$colour = '#00089c';
		}elseif($key == 'bumn'){
			$colour = '#d0295f';
		}elseif($key == 'sekolah-dinas'){
			$colour = '#b38e85';
		}
		$dataSiswa[] = [ 'label' => $key , 'data' => $value->toArray(), 'backgroundColor' => $colour ];
	}

	// datasets:[
	// 		{ label:'cpns', data:['50','13'],backgroundColor:'rgba(255, 99, 132, 0.2)', },
	// 		{ label:'pppk', data:['15','13'],backgroundColor:'rgba(20, 99, 111, 0.2)', },
	// 		{ label:'popo', data:['15','14'] },
	// 		]
	// dd($dataSiswa,$map->toArray(), );
	return view('grafik.chart')->with('data', json_encode($dataSiswa))->with('tahun', json_encode($tahun));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () { 
	Route::resource('/grafik', 'GrafikController');
});
