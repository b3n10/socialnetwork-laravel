<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FriendController extends Controller
{
	public function getIndex() {
		$friends = Auth::user()->friends();
		$friend_request = Auth::user()->friendRequest();

		return view('friend.index', compact('friends', 'friend_request'));
	}
}
