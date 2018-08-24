<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;

use Auth;

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
		$validator = Validator::make($request->all(), [
			'username'	=>	'required',
			'password'	=>	'required'
		]);

		if ($validator->fails()) {
			return redirect()->route('auth.signin')
				->withErrors($validator)
				->withInput();
		}

		if (Auth::attempt($request->only(['username', 'password'], $request->has('remember')))) {
			return redirect()
				->route('home')
				->with(
					'success',
					'You are now logged in !'
				);
		}

		return redirect()
			->back()
			->with(
				'danger',
				'Invalid email/password !'
			);

	}

	public function getSignOut() {
		Auth::logout();

		return redirect()
			->route('home')
			->with(
				'success',
				'You are now logged out!'
			);
	}
}
