<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use Yajra\Datatables\Facades\Datatables;

class RefSifatPeraturanController extends Controller
{
	protected $kdlevel;
	protected $table='r_label';

	public function __construct()
	{
		$this->kdlevel = session('kdlevel');
	}

	public function index()
	{
		$query = DB::select("
			SELECT 	id,
					sifat_peraturan,
					aktif
			FROM r_sifat_peraturan
			ORDER BY id
		");
		$rows=collect($query);

		$datatables = Datatables::of($rows)
			->addIndexColumn()
			->addColumn('action', function($row){
				return view('action.general',[
					'id'=>$row->id,
					'kdlevel'=>$this->kdlevel,
				]);
			})
			->make(true);

		return $datatables;
	}

	//tampilkan sifat peraturan
	public function getSifatPeraturanById($id)
	{
		$rows = DB::select("
			select * 
			from r_sifat_peraturan
			where id=".$id."
			");

		if (isset($rows[0])) {
			return response()->json($rows[0]);
		}
	}

	//simpan jenis peraturan baru
	public function store(Request $request)
	{
		try {
			$insert=DB::insert('
				INSERT INTO r_sifat_peraturan (sifat_peraturan)
				VALUES (?)
			',[
				htmlspecialchars($request->input('sifat-peraturan'))
			]);

			if($insert){
				return 'success';
			}
			else{
				return 'Proses simpan gagal!';
			}
		} catch (\Exception $e) {
			//return $e->getMessage();
			return 'Terdapat kesalahan. Hubungi Admin!';
		}
	}

	//rekam ubah sifat peraturan
	public function update(Request $request)
	{
		try {
			$update=DB::update('
				UPDATE r_sifat_peraturan
				SET sifat_peraturan=?
				WHERE id=?
			',[
				htmlspecialchars($request->input('sifat-peraturan')),
				$request->input('inp-id')
			]);

			if($update) {
				return 'success';
			}
			else{
				return 'Proses ubah gagal!';
			}
		} catch (\Exception $e) {
			//return $e->getMessage();
			return 'Terdapat kesalahan. Hubungi Admin!';
		}
	}

	//hapus sifat peraturan
	public function destroy(Request $request)
	{
		try {
			$delete=DB::delete('DELETE FROM r_sifat_peraturan WHERE id=?', [$request->input('id')]);
			
			if($delete) {
				return 'success';
			}
			else{
				return 'Proses hapus gagal!';
			}
		} catch (\Exception $e) {
			//return $e->getMessage();
			return 'Terdapat kesalahan. Hubungi Admin!';
		}
	}
}