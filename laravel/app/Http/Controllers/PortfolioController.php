<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class PortfolioController extends BaseController
{
    public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return view('portfolio');
	}

	/*public function login()
	{
		return view('login');
	}*/
}
