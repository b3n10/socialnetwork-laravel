<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Status;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email',
		'username',
		'password',
		'first_name',
		'last_name',
		'location'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function getFullName() {
		return "{$this->first_name} {$this->last_name}";
	}

	public function getFirstName() {
		return "{$this->first_name}";
	}

	public function getUsername() {
		return "{$this->username}";
	}

	public function getName() {
		if ($this->first_name && $this->last_name) return $this->getFullName();
		if ($this->first_name) return $this->getFirstName();
		if ($this->username) return $this->getUsername();
	}

	public function statuses() {
		return $this->hasMany('App\Models\Status', 'user_id');
	}

	public function likes() {
		return $this->hasMany('App\Models\Like', 'user_id');
	}

	public function getAvatarUrl() {
		return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=retro&s=40";
	}

	public function ownFriends() {
		return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
	}

	public function othersFriends() {
		return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
	}

	public function friends() {
		return $this->ownFriends()->wherePivot('accepted', true)->get()
			->merge($this->othersFriends()->wherePivot('accepted', true)->get());
	}

	public function friendRequests() {
		return $this->ownFriends()->wherePivot('accepted', false)->get();
	}

	public function friendRequestsPending() {
		return $this->othersFriends()->wherePivot('accepted', false)->get();
	}

	public function hasFriendRequestsPending(User $user) {
		return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
	}

	public function hasFriendRequestsReceived(User $user) {
		return (bool) $this->friendRequests()->where('id', $user->id)->count();
	}

	public function addFriend(User $user) {
		$this->othersFriends()->attach($user->id, ['accepted' => false]);
	}

	public function acceptFriendRequest(User $user) {
		$this->friendRequests()->where('id', $user->id)->first()->pivot->update([
			'accepted'	=>	true
		]);
	}

	public function isFriendsWith(User $user) {
		return (bool) $this->friends()->where('id', $user->id)->count();
	}

	public function hasLikedStatus(Status $status) {
		return (bool) $status->likes
			->where('likeable_id', $status->id)
			->where('likeable_type', get_class($status))
			->where('user_id', $this->id)
			->count();
	}

	public function getLikeCount($statusId) {
		$status = Status::find($statusId);

		if (!$status) return redirect()->route('home')->with('danger', 'Access denied!');

		return $status->likes->where('likeable_id', $status->id)->count();
	}
}
