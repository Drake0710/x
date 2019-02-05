<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use Yajra\Datatables\Facades\Datatables;

class RefLabelController extends Controller {

	protected $kdlevel;
	protected $table='r_label';

	public function __construct()
	{
		$this->kdlevel = session('kdlevel');
	}

	public function index()
	{
		$query = DB::select("SELECT id,label,aktif FROM r_label ORDER BY id");
		$rows=collect($query);

		$datatables = Datatables::of($rows)
			->addIndexColumn()
			->addColumn('action', function($row){
				return view('action.ref-label',[
					'id'=>$row->id,
					'kdlevel'=>$this->kdlevel,
				]);
			})
			->make(true);

		return $datatables;
	}
	
	public function getLabelById($id)
	{
		$rows = DB::select("
			select *
			from r_label
			where id=".$id."
		");
		
		if(isset($rows[0])){
			return response()->json($rows[0]);
		}
	}

	public function store(Request $request)
	{
		try {
			$insert=DB::insert('INSERT INTO r_label (label) VALUES (?)',
				[
					htmlspecialchars($request->input('label'))
				]
			);

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
	
	public function update(Request $request)
	{
		try {
			$update=DB::update('
				UPDATE r_label
				SET label=?
				WHERE id=?
			',[
				htmlspecialchars($request->input('label')),
				$request->input('inp-id')
			]);

			if($update){
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
	
	public function destroy(Request $request)
	{
		try {
			$delete=DB::delete('DELETE FROM r_label where id=?', [$request->input('id')]);
			
			if($delete){
				return 'success';
			}
			else{
				return 'Proses hapus gagal. Hubungi Admin!';
			}
		} catch (\Exception $e) {
			//return $e->getMessage();
			return 'Terdapat kesalahan. Hubungi Admin!';
		}
	}
}
