<?php

class Collaborator extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'collaborators';

	/**
	 * The attributes focused by mass assignment.
	 */
	protected $fillable = array(
		'id',
		'movie',
		'name',
		'role',
	);
}