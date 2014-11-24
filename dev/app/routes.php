<?php

Route::pattern('id', '[0-9]+');

/* Basic routes */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showIndex'));
Route::get('/admin', array('as' => 'admin.home', 'uses' => 'Admin\HomeController@showIndex'));
Route::when('admin/*', 'auth' );
Route::when('admin', 'auth' );

/* Authorized routes */
Route::group(array('before' => 'auth'), function() {

    /* Users */
    Route::get('/profile', array('as' => 'profile', 'uses' => 'UsersController@showProfile'));
    Route::post('/profile', array('as' => 'profile', 'uses' => 'UsersController@postUpdate'));
    Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@showLogout'));

    /* Cards */
    Route::get('/cards/{id}/edit', array('as' => 'public.cards.edit', 'uses' => 'CardsController@showEdit'));
    Route::post('/cards/{id}/edit', array('as' => 'public.cards.update', 'uses' => 'CardsController@postUpdate'));
    Route::post('/cards/{id}/delete', array('as' => 'public.cards.delete', 'uses' => 'CardsController@postDelete'));
    Route::get('/cards/manage', array('as' => 'public.cards.manage', 'uses' => 'CardsController@showManage'));
});


/* Public routes */
/* Members */
Route::get('/members', array('as' => 'public.members', 'uses' => 'UsersController@showIndex'));
Route::get('/members/{id}', array('as' => 'public.member', 'uses' => 'UsersController@showView'));

/* Users */
Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@showIndex'));
Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@postLogin'));

Route::get('/register', array('as' => 'register', 'uses' => 'AuthController@showNew'));
Route::post('/register', array('as' => 'register', 'uses' => 'AuthController@postCreate'));

/* Cards */
Route::get('/cards', array('as' => 'public.cards', 'uses' => 'CardsController@showNew'));
Route::get('/cards/new', array('as' => 'public.cards.new', 'uses' => 'CardsController@showNew'));
Route::post('/cards/new', array('as' => 'public.cards.create', 'uses' => 'CardsController@postCreate'));
Route::get('/cards/{id}', array('as' => 'public.cards.details', 'uses' => 'CardsController@showDetails'));

/* Categories */
Route::get('/categories/{id}', array('as' => 'public.categories.details', 'uses' => 'CategoriesController@showDetails'));

/* Pages */
Route::get('/pages/{id}', array('as' => 'public.pages.details', 'uses' => 'PagesController@showDetails'));

/* Administration routes */
/* Pages */
Route::get('/admin/pages', array('as' => 'admin.pages', 'uses' => 'Admin\PagesController@showIndex'));
Route::get('/admin/pages/new', array('as' => 'admin.pages.new', 'uses' => 'Admin\PagesController@showNew'));
Route::post('admin/pages/new', array('as' => 'admin.pages.create', 'uses' => 'Admin\PagesController@postCreate'));
Route::get('/admin/pages/{id}/edit', array('as' => 'admin.pages.edit', 'uses' => 'Admin\PagesController@showEdit'));
Route::post('/admin/pages/{id}/edit', array( 'as' => 'admin.pages.update', 'uses' => 'Admin\PagesController@postUpdate'));
Route::post('/admin/pages/{id}/delete', array( 'as' => 'admin.pages.delete', 'uses' => 'Admin\PagesController@postDelete'));

/* Categories */
Route::get('/admin/categories', array('as' => 'admin.categories', 'uses' => 'Admin\CategoriesController@showIndex'));
Route::get('/admin/categories/new', array('as' => 'admin.categories.new', 'uses' => 'Admin\CategoriesController@showNew'));
Route::post('admin/categories/new', array('as' => 'admin.categories.create', 'uses' => 'Admin\CategoriesController@postCreate'));
Route::get('/admin/categories/{id}/edit', array('as' => 'admin.categories.edit', 'uses' => 'Admin\CategoriesController@showEdit'));
Route::post('/admin/categories/{id}/edit', array( 'as' => 'admin.categories.update', 'uses' => 'Admin\CategoriesController@postUpdate'));
Route::post('/admin/categories/{id}/delete', array( 'as' => 'admin.categories.delete', 'uses' => 'Admin\CategoriesController@postDelete'));

/* Cards */
Route::get('/admin/cards/', array('as' => 'admin.cards', 'uses' => 'Admin\CardsController@showIndex'));
Route::get('/admin/cards/create', array('as' => 'admin.cards.new', 'uses' => 'Admin\CardsController@showNew'));
Route::post('/admin/cards/create', array('as' => 'admin.cards.create', 'uses' => 'Admin\CardsController@postCreate'));
Route::get('/admin/cards/{id}/edit', array('as' => 'admin.cards.edit', 'uses' => 'Admin\CardsController@showEdit'));
Route::post('/admin/cards/{id}/edit', array('as' => 'admin.cards.update', 'uses' => 'Admin\CardsController@postUpdate'));
Route::post('/admin/cards/{id}/delete', array('as' => 'admin.cards.delete', 'uses' => 'Admin\CardsController@postDelete'));
