<?php

namespace Admin;

use \Controller;
use \Route;
use \View;

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
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if ( ! is_null($this->layout)) {
            $route_parts = explode( '.', Route::currentRouteName() );
            $this->layout = View::make($this->layout)
                ->with('route_name', Route::currentRouteName())
                ->with('route_parent', $route_parts[0])
                ->with('styles', $this->styles)
                ->with('scripts', $this->scripts)
                ->with('inline_js', $this->inline_js);
        }
    }

}
