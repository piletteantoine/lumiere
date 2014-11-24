<?php

class PagesController extends BaseController {

    protected $layout = 'public.templates.main';

    public function showDetails($id) {
    	$page = Page::find($id);
        
        // If no item in database
        if(empty($page) || empty($page->id))
            return Redirect::route('home')
                ->with('message', Lang::get('pages.inexistant'));

	    $this->layout->content = View::make('public.pages.details');
        $this->layout->content->page = $page;
        $this->layout->content_title = $page->title;

    }

}