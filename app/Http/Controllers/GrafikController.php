<?php

namespace App\Http\Controllers;

use App\Grafik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class GrafikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
    		$data = Grafik::get();
    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('tahun', function ($row) {
    			$tahun = $row->tahun;
    			return $tahun;
    		})     
    		->addColumn('kategori', function ($row) {
    			$kategori = $row->kategori;
    			return $kategori;
    		})     
    		->addColumn('siswa', function ($row) {
    			$siswa = $row->siswa;
    			return $siswa;
    		})         		
    		->addColumn('siswa_lulus', function ($row) {
    			$siswa_lulus = $row->siswa_lulus;
    			return $siswa_lulus;
    		})     
    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning" href="'.action('GrafikController@edit', $row->id).'" >Edit</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view ('grafik.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$cek = Grafik::where('tahun', date('Y'))->get();
    	if(!empty($cek)){
    		Alert::warning('Peringatan!', 'Data Pertahun Sudah Lengkap, silahkan edit data yang sudah ada');
    		return back();
    	} 

    	$tahun = 2005;
    	$data = [];
    	while ( $tahun <= date('Y')) {
    		$data[] = $tahun++;
    	}
    	$kategori = ['polri', 'tni', 'bumn', 'cpns','sekolah-dinas'];

    	foreach ($data as $key => $tahun) {
    		foreach ($kategori as $kat) {
    			$input['tahun'] = $tahun;
    			$input['kategori'] = $kat;
    			$input['siswa'] = rand(40,60);
    			$input['siswa_lulus'] = rand(30,50);
    			Grafik::create($input);
    		}
    	}
        return view('grafik.create', compact('data', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	foreach ($request->kategori as $key => $value) {
	        $input['tahun'] = $request->tahun;
	        $input['kategori'] = $key;
	        $input['siswa'] = $value['siswa'];
	        $input['siswa_lulus'] = $value['siswa_lulus'];
	        Grafik::create($input);
    	}
    	return redirect()->action('GrafikController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function show(Grafik $grafik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Grafik::find($id);
        return view('grafik.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id	)
    {
    	if($request->siswa_lulus > $request->siswa){
    		Alert::warning('Peringatan!', 'Siswa yang Lulus tidak boleh lebih besar dari jumlah siswa');
    		return back();
    	}

        Grafik::whereId($id)->update([
        	'siswa' => $request->siswa,
        	'siswa_lulus' => $request->siswa_lulus,
        ]);

        return redirect()->action('GrafikController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grafik $grafik)
    {
        //
    }
}
