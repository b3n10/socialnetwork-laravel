<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class ProfileController extends Controller
{
	public function getProfile($username) {
		$user = User::where('username', $username)->first();

		if (!$user) abort(404);

		return view('profile.index', compact('user'));
	}

	public function getEdit(Request $request) {
		$user = Auth::user();

		return view('profile.edit', compact('user'));
	}

	public function postEdit(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name'	=>	'alpha|max:50',
			'last_name'		=>	'alpha|max:50',
			'location'		=>	'max:50'
		]);

		if ($validator->fails()) {
			return redirect()
				->route('profile.edit')
				->withErrors($validator)
				->withInput();
		}

		Auth::user()->update([
			'first_name'	=>	$request->input('first_name'),
			'last_name'		=>	$request->input('last_name'),
			'location'		=>	$request->input('location')
		]);

		return redirect()
			->route('profile.edit')
			->with(
				'info',
				'Successfully updated info :)'
			);
	}

}
