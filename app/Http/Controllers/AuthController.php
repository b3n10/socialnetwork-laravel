<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

class AuthController extends Controller
{
	public function getSignUp() {
		return view('auth.signup');
	}

	public function postSignUp(Request $request) {
		$validator = Validator::make($request->all(), [
			'email'			=>	'required|unique:users|email|max:255',
			'username'	=>	'required|unique:users|alpha_dash|max:20',
			'password'	=>	'required|min:6'
		]);

		if ($validator->fails()) {
			return redirect()->route('auth.signup')
				->withErrors($validator)
				->withInput();
		}

		User::create([
			'email'	=>	$request->input('email'),
			'username'	=>	$request->input('username'),
			'password'	=>	bcrypt($request->input('password'))
		]);

		return redirect()->route('home')->with(
			'info',
			'Account successfully created! You can now login :)'
		);
	}

	public function getSignIn() {
		return view('auth.signin');
	}

	public function postSignIn(Request $request) {
		dd($request);
	}
}
