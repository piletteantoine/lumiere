<?php

class Page extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

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
	protected $fillable = array('title', 'content', 'published_on', 'excerpt', 'author_id');
}
