<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('password');

	public static $rules = array(
		'email'                 => 'required|email|unique:users',
		'password'              => 'required|min:7|confirmed',
		'password_confirmation' => 'required',
		'first_name'            => 'required|min:2',
		'last_name'             => 'required|min:2'
	);

	public static $rules_update = array(
		'email'                 => 'required|email',
		'password'              => 'alpha_num|min:7|confirmed',
		'password_confirmation' => 'alpha_num',
		'first_name'            => 'required|min:2',
		'last_name'             => 'required|min:2'
	);

	public function role() {
		return $this->belongsTo('Role');
	}

	public function cards() {
		return $this->hasMany('Card', 'user_id', 'id');
	}

	public function get_avatar_url() {
		$avatar_url = 'uploads/avatars/' . $this->id . '.png';
		if( File::exists( $avatar_url ) ) {
			return asset( $avatar_url );
		}
		return false;
	}

}
