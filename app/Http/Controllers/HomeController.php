<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
	public function index() {
		if (Auth::check()) return view('timeline.index');

		return view('home');
	}
}
