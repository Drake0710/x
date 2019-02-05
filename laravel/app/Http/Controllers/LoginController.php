<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Cookie;
use App\Http\Requests;
use DB;
use Session;

class LoginController extends BaseController
{
    public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return view('login');
	}

	public function login(Request $request)
	{
		try {
			
			$username = $request->input('login-form-username');
			$password = $request->input('login-form-password');
			
			if($username=='alan' && $password=='alanummi07'){
				session([
					'authenticated'  => true
				]);
				
				return response(json_encode(array('error' => false,'message' => './admin')), 200);
			}				
			else{
				return response(json_encode(array('error' => true,'message' => 'Username/password salah!')), 403);
			}
			
		}
		catch(\Exception $e) {
			return response(json_encode(array('error' => true,'message' => 'Koneksi terputus!')), 500);
			//return $e;
		}
	}
}
