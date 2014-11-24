<?php

class Role extends Eloquent {

    protected $table = 'roles';

    public static $rules = array(
        'name_tag' => 'required|unique:roles',
    );

    public function users() {
        return $this->hasMany('User');
    }

}
