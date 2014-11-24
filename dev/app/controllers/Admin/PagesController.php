<?php

namespace Admin;

use \View, \Page, \Lang, \Validator, \Input, \Redirect, \Auth;

class PagesController extends BaseController {

    protected $layout = 'admin.templates.main';

    public function __construct() {
        $this->scripts[] = '/assets/js/admin/pages.js';
    }

    public function showIndex() {

    	$pages = Page::all();

        $this->layout->content = View::make('admin.pages.index');
        $this->layout->content->pages = $pages;

        $this->layout->title = Lang::get('admin.pages.index.title');
    }

    public function showNew() {

    	$this->layout->content = View::make('admin.pages.new');
    }

    public function postCreate() {
        $rules = array(
            'title' => 'required',
            'content' => 'required',
            'published_on_time' => array(
                'required',
                'date_format:H:i'
            ),
            'published_on_date' => array(
                'required',
                'date_format:Y-m-d'
            )
        );
        
        $validator = Validator::make( Input::all(), $rules );
        
        if( $validator->passes() ) {

        	$input_content = Input::get('content');
        	$input_excerpt = Input::get('excerpt');

        	$excerpt = (empty($input_excerpt)) ? substr($input_content, 0, 300) : $input_excerpt;
        	
        	$published_on = \DB::raw('NOW()');

        	if(Input::get('use_current_time', null) == null){
        		$published_on_date = Input::get('published_on_date');
        		$published_on_time = Input::get('published_on_time');
        		
        		$processed_date = \DateTime::createFromFormat('Y-m-d H:i', $published_on_date . ' ' . $published_on_time);

				try {
					$published_on = $processed_date->format('Y-m-d H:i:s');
				} catch(Exception $e){
					return Redirect::back()->with('message', Lang::get('admin/pages.new.no_datetime'))->withInput();
				}
        	}
        	
        	$page = Page::create(
        		array(
					'title'        => Input::get('title'),
					'content'      => $input_content,
					'excerpt'      => $excerpt,
					'published_on' => $published_on,
					'author_id'    => Auth::user()->id
        		)
        	);

            return Redirect::route('admin.pages')->with('message', Lang::get('admin/pages.new.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('admin/pages.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function showEdit($id) {
    	$page = Page::find($id);
        
    	// If no item in database
        if(empty($page) || empty($page->id))
            return Redirect::route('admin.pages')
                ->with('message', Lang::get('admin/pages.edit.inexistant'));

        $this->layout->content = View::make('admin.pages.edit');
        $this->layout->content->page = $page;
        
        $this->layout->breadcrumbs = array(
            'pages' => Lang::get('admin/menu.pages.title'),
            '' => Lang::get('admin/menu.pages.edit')
        );
        $this->layout->title = Lang::get('admin/menu.pages.edit');
    }

    public function postUpdate($id) {
        $page = Page::find($id);
        
    	// If no item in database
        if(empty($page) || empty($page->id))
            return Redirect::route('admin.pages')
                ->with('message', Lang::get('admin/pages.edit.inexistant'));

		$rules = array(
            'title' => 'required',
            'content' => 'required',
            'published_on_time' => array(
                'required',
                'date_format:H:i',
            ),
            'published_on_date' => array(
                'required',
                'date_format:Y-m-d'
            )
        );
        
        $validator = Validator::make( Input::all(), $rules );
        
        if( $validator->passes() ) {

        	$input_content = Input::get('content');
        	$input_excerpt = Input::get('excerpt');

        	$excerpt = (empty($input_excerpt)) ? substr($input_content, 0, 300) : $input_excerpt;
        	
        	$published_on = \DB::raw('NOW()');

        	if(Input::get('use_current_time', null) == null){
        		$published_on_date = Input::get('published_on_date');
        		$published_on_time = Input::get('published_on_time');
        		
        		$processed_date = \DateTime::createFromFormat('Y-m-d H:i', $published_on_date . ' ' . $published_on_time);

				try {
					$published_on = $processed_date->format('Y-m-d H:i:s');
				} catch(Exception $e){
					return Redirect::back()->with('message', Lang::get('admin/pages.new.no_datetime'))->withInput();
				}
        	}
        	
        	$page->fill(
        		array(
					'title'        => Input::get('title'),
					'content'      => $input_content,
					'excerpt'      => $excerpt,
					'published_on' => $published_on,
					'author_id'    => Auth::user()->id
        		)
        	)->save();

            return Redirect::route('admin.pages')->with('message', Lang::get('admin/pages.update.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('admin/pages.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove a log
     * @return Response request response
     */
    public function postDelete($id) {
  		$page = Page::find($id);
        
    	// If no item in database
        if(empty($page) || empty($page->id))
            return Redirect::route('admin.pages')
                ->with('message', Lang::get('admin/pages.edit.inexistant'));

        try {
			$page->delete();
		} catch(Exception $e){
			return Redirect::back()->with('message', Lang::get('admin/pages.new.error_delete'))->withInput();
		}

		return Redirect::route('admin.pages')->with('message', Lang::get('admin/pages.delete.message', array('title' => Input::get('title'))));
    }



}