<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	if ($request->ajax()) {
    		$data = Karyawan::get();
    		return Datatables::of($data)
    		->addIndexColumn()
    		->addColumn('nip', function ($row) {
    			$nip = $row->nip;
    			return $nip;
    		})     
    		->addColumn('nama', function ($row) {
    			$nama = $row->nama;
    			return $nama;
    		})     
    		->addColumn('alamat', function ($row) {
    			$alamat = $row->alamat;
    			return $alamat;
    		})     
    		->addColumn('no_hp', function ($row) {
    			$no_hp = $row->no_telp;
    			return $no_hp;
    		})                
    		->addColumn('email', function ($row) {
    			$email = $row->email;
    			return $email;
    		})     

    		->addColumn('action', function ($row) {
    			$action =  '<a class="btn btn-sm btn-warning py-0 edit" style="font-size: 0.8em;" data-id="'.$row->id.'" >Edit</a>';
    			$action = $action. '<a class="btn btn-sm btn-danger text-white py-0 mx-2 hapus" style="font-size: 0.8em;" data-id="'.$row->id.'" >Hapus</a>';
    			return $action;
    		})
    		->rawColumns(['action'])
    		->make(true);
    	}

    	return view ('karyawan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	Karyawan::updateOrCreate(
    		[
    			'id' => $request->id
    		],
    		[
    			'nip' => $request->nip,
    			'nama' => $request->nama,
    			'alamat' => $request->alamat,
    			'no_telp' => $request->no_hp,
    			'email' => $request->email,
    		]
    	);

    	return response()->json(
    		[
    			'success' => true,
    			'message' => 'Data inserted successfully'
    		]
    	);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$karyawan  = Karyawan::find($id);

    	return response()->json([
    		'data' => $karyawan
    	]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$karyawan = Karyawan::find($id);

    	$karyawan->delete();

    	return response()->json([
    		'message' => 'Data deleted successfully!'
    	]);
    }
}
