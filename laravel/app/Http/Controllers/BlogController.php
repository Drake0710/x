<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class BlogController extends BaseController
{
    public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return view('blog');
	}

	/*public function login()
	{
		return view('login');
	}*/
}
