<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Validator;

class SearchController extends Controller
{
	public function getResults(Request $request) {
		$query = $request->input('query');

		$validator = Validator::make($request->all(), [
			'query'	=>	'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->with(
					'danger',
					$validator->errors()->first('query')
				);
		}

		$users = User::where(
			DB::raw("CONCAT(first_name, ' ', last_name)"),
			'LIKE', "%{$query}%"
		)->orWhere('username', 'LIKE', "%{$query}%")
		->get();

		if ($users->count()) $results_string = "Search results found {$users->count()} user(s)";
		else $results_string = "No results found for '{$query}' !";

		return view('search.results', [
			'users'						=>	$users,
			'results_string'	=>	$results_string
		]);
	}
}
