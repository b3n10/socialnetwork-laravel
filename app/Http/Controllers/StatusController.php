<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Status;

class StatusController extends Controller
{
	public function postStatus(Request $request) {
		$this->validate($request, [
			'status'	=>	'required|max:1000'
		]);

		Auth::user()->statuses()->create([
			'body'	=>	$request->input('status')
		]);

		return redirect()
			->route('home')
			->with('info', 'You post has been added :)');
	}

	public function postReply(Request $request, $statusId) {
		$this->validate($request, [
			"reply-{$statusId}" => 'required:max:1000'
		], [
			'required' =>	'The reply body is required.'
		]);

		// check if statusId exists in db
		$status = Status::notReply()->find($statusId);

		// redirect if not
		if (!$status) return redirect()
			->route('home')
			->with('danger', 'Access denied!');

		// deny replying to post of not friend
		if (!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) return redirect()
			->route('home')
			->with('danger', 'Access denied!');

		// insert 'body' into table
		// make sure 'user_id' is nullable in migrations or else error about null value
		$reply = Status::create([
			'body'	=>	$request->input("reply-{$statusId}")
		])->user()->associate(Auth::user());

		// add $statusId in 'parent_id' of $reply
		$status->replies()->save($reply);

		return redirect()
			->route('home')
			->with('info', 'You reply has been added :)');
	}

	public function getLike($statusId) {
		$status = Status::find($statusId);

		if (!$status) return redirect()->route('home')->with('danger', 'Access denied!');

		if (!Auth::user()->isFriendsWith($status->user)) return redirect()->route('home');

		if (Auth::user()->hasLikedStatus($status)) return redirect()->back();

		$like = $status->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back();
	}
}
