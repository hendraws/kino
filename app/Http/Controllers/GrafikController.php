<?php

namespace App\Http\Controllers;

use App\Grafik;
use Illuminate\Http\Request;
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
    			$action =  '<a class="btn btn-sm btn-warning py-0 edit" style="font-size: 0.8em;" data-id="'.$row->id.'" >Edit</a>';
    			$action = $action. '<a class="btn btn-sm btn-danger text-white py-0 mx-2 hapus" style="font-size: 0.8em;" data-id="'.$row->id.'" >Hapus</a>';
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
    	$tahun = 2005;
    	$data = [];
    	while ( $tahun <= date('Y')) {
    		$data[] = $tahun++;
    	}
    	$kategori = ['polri', 'tni', 'bumn', 'cpns','sekolah-dinas'];
    
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
    public function edit(Grafik $grafik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grafik  $grafik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grafik $grafik)
    {
        //
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
