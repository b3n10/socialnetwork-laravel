<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class FriendController extends Controller
{
	public function getIndex() {
		$friends = Auth::user()->friends();
		$friend_request = Auth::user()->friendRequests();

		return view('friend.index', compact('friends', 'friend_request'));
	}

	public function getAdd($username) {
		$user = User::where('username', $username)->first();

		if (!$user)
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('danger', 'User could not be found!');

		if (Auth::user()->hasFriendRequestsPending($user) || $user->hasFriendRequestsPending(Auth::user()))
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('info', 'Friend request already sent.');

		if (Auth::user()->isFriendsWith($user))
			return redirect()
				->route('profile.index', ['username' => $username])
				->with('info', "You are already friends with $username.");

		Auth::user()->addFriend($user);

		return redirect()
			->route('profile.index', ['username' => $username])
			->with('info', 'Friend request sent :)');
	}
}
