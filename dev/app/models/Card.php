<?php

class Card extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cards';

	/**
	 * The attributes focused by mass assignment.
	 */
	protected $fillable = array(
		'title',
		'description',
		'poster_url',
		'thumb_url',
		'date_publication',
		'date_production',
		'video_url',
		'length',
		'is_trailer',
		'location',
		'location_lat',
		'location_long',
		'categories_id',
		'user_id'
	);

	public static $rules = array(
		'title'          => 'required|min:3',
		'category_id'	 => 'required|exists:categories,id'
	);

	public function author() {
		return $this->hasOne('User', 'id', 'user_id' );
	}

	public function category() {
		return $this->hasOne('Category', 'id', 'category_id' );
	}

	public function get_image( $size = 'medium' ) {
		$avatar_url = 'uploads/cards/' . $this->id . '_' . $size . '.png';
		if( File::exists( $avatar_url ) ) {
			return asset( $avatar_url );
		} else {
			switch( $size ) {
				case 'medium':
					return 'http://lorempixel.com/400/200';
				case 'banner':
					return 'http://lorempixel.com/400/200';
			}
		}
		return false;
	}

	public function get_poster($width = 400, $height = 200) {
		$file_url = 'uploads/cards/posters/' . $this->id . '.png';
		return ( File::exists( $file_url ) ) ? asset(Croppa::url( $file_url, $width, $height )) : 'http://lorempixel.com/' . $width . '/' . $height;
	}

	public function get_thumb($width = 64, $height = 64) {
		$file_url = 'uploads/cards/thumbs/' . $this->id . '.png';
		return ( File::exists( $file_url ) ) ? asset(Croppa::url( $file_url, $width, $height )) : 'http://lorempixel.com/' . $width . '/' . $height;
	}
}