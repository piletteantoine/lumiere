<?php

class BaseController extends Controller {

	protected $styles = array(
        '/assets/css/summernote.css',
    );

    protected $scripts = array(
        '/assets/js/summernote.min.js',
        '/assets/js/main.js',
    );

	protected $inline_js = '';
	/**
	 * @author Romain Carlier
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {

			$categories = Category::all();
			$pages = Page::all();

			$this->layout = View::make($this->layout)
			    ->with('styles', $this->styles)
			    ->with('scripts', $this->scripts)
			    ->with('content_title', '')
			    ->with('categories', $categories)
			    ->with('pages', $pages)
			    ->with('inline_js', $this->inline_js)
                ->with('sidebar', null);
		}
	}

}
