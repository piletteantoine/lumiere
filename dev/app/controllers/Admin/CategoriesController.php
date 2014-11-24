<?php

namespace Admin;

use \View, \Category, \Lang, \Validator, \Input, \Redirect, \Auth;

class CategoriesController extends BaseController {

    protected $layout = 'admin.templates.main';

    public function __construct() {
        //$this->scripts[] = '/assets/js/admin/categories.js';
    }

    public function showIndex() {

    	$categories = Category::all();

        $this->layout->content = View::make('admin.categories.index');
        $this->layout->content->categories = $categories;

        $this->layout->title = Lang::get('admin.categories.index.title');
    }

    public function showNew() {

    	$this->layout->content = View::make('admin.categories.new');
    }

    public function postCreate() {
        $rules = array(
            'title' => 'required',
        );
        
        $validator = Validator::make( Input::all(), $rules );
        
        if( $validator->passes() ) {

        	$category = Category::create(
        		array(
					'title'        => Input::get('title'),
					'description'  => Input::get('description'),
        		)
        	);

            $poster = Input::file('poster', null);
            if( null !== $poster ) {
                $destination_path = 'uploads/categories/posters';
                $file_name = $category->id;

                $path_parts = explode('.', $poster->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $poster_passes = Input::file('poster')->move($destination_path, $file_name . '.png');
            } else {
                $poster_passes = true;
            }

            if(!$poster_passes){
                return Redirect::back()
                    ->with('message', Lang::get('admin/categories.poster.bad_upload_error'))
                    ->withInput();
            }

            $thumb = Input::file('thumb', null);
            if( null !== $thumb ) {
                $destination_path = 'uploads/categories/thumbs';
                $file_name = $category->id;

                $path_parts = explode('.', $thumb->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $thumb_passes = Input::file('thumb')->move($destination_path, $file_name . '.png');
            } else {
                $thumb_passes = true;
            }

            if(!$thumb_passes){
                return Redirect::back()
                    ->with('message', Lang::get('admin/categories.thumb.bad_upload_error'))
                    ->withInput();
            }

            return Redirect::route('admin.categories')
                ->with('message', Lang::get('admin/categories.new.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('admin/categories.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function showEdit($id) {
    	$category = Category::find($id);
        
    	// If no item in database
        if(empty($category) || empty($category->id))
            return Redirect::route('admin.categories')
                ->with('message', Lang::get('admin/categories.edit.inexistant'));

        $this->layout->content = View::make('admin.categories.edit');
        $this->layout->content->category = $category;
        
        $this->layout->breadcrumbs = array(
            'categories' => Lang::get('admin/menu.categories.title'),
            '' => Lang::get('admin/menu.categories.edit')
        );
        $this->layout->title = Lang::get('admin/menu.categories.edit');
    }

    public function postUpdate($id) {
        $category = Category::find($id);
        
    	// If no item in database
        if(empty($category) || empty($category->id))
            return Redirect::route('admin.categories')
                ->with('message', Lang::get('admin/categories.edit.inexistant'));

		$rules = array(
            'title' => 'required',
        );
        
        $validator = Validator::make( Input::all(), $rules );
        
        if( $validator->passes() ) {

        	$category->fill(
        		array(
					'title'        => Input::get('title'),
					'description'  => Input::get('description'),
        		)
        	)->save();

            $poster = Input::file('poster', null);
            if( null !== $poster ) {
                $destination_path = 'uploads/categories/posters';
                $file_name = $category->id;

                $path_parts = explode('.', $poster->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $poster_passes = Input::file('poster')->move($destination_path, $file_name . '.png');
            } else {
                $poster_passes = true;
            }

            if(is_bool($poster_passes) && $poster_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('admin/categories.poster.bad_upload_error'))
                    ->withInput();
            }

            $thumb = Input::file('thumb', null);
            if( null !== $thumb ) {
                $destination_path = 'uploads/categories/thumbs';
                $file_name = $category->id;

                $path_parts = explode('.', $thumb->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $thumb_passes = Input::file('thumb')->move($destination_path, $file_name . '.png');
            } else {
                $thumb_passes = true;
            }

            if(is_bool($thumb_passes) && $thumb_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('admin/categories.thumb.bad_upload_error'))
                    ->withInput();
            }

            return Redirect::route('admin.categories')->with('message', Lang::get('admin/categories.update.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('admin/categories.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove a log
     * @return Response request response
     */
    public function postDelete($id) {
  		$category = Category::find($id);
        
    	// If no item in database
        if(empty($category) || empty($category->id))
            return Redirect::route('admin.categories')
                ->with('message', Lang::get('admin/categories.edit.inexistant'));

        try {
			$category->delete();
            Croppa::delete('uploads/categories/thumbs/' . $id . '.png');
            Croppa::delete('uploads/categories/posters/' . $id . '.png');
		} catch(Exception $e){
			return Redirect::back()->with('message', Lang::get('admin/categories.new.error_delete'))->withInput();
		}

		return Redirect::route('admin.categories')->with('message', Lang::get('admin/categories.delete.message', array('title' => Input::get('title'))));
    }



}