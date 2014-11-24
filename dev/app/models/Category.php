<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	/**
	 * The attributes focused by mass assignment.
	 * 
	 */
	protected $fillable = array('title', 'description');

	public function get_poster($width = 1000, $height = 300) {
		$file_url = 'uploads/categories/posters/' . $this->id . '.png';
		return ( File::exists( $file_url ) ) ? asset(Croppa::url( $file_url, $width, $height )) : 'http://placehold.it/' . $width . 'x' . $height . '/ccc/ccc';
	}

	public function get_thumb($width = 64, $height = 64) {
		$file_url = 'uploads/categories/thumbs/' . $this->id . '.png';
		return ( File::exists( $file_url ) ) ? asset(Croppa::url( $file_url, $width, $height )) : 'http://placehold.it/' . $width . 'x' . $height . '/ccc/ccc';
	}
}
