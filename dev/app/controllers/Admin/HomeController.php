<?php

namespace Admin;

use \View;

class HomeController extends BaseController {

    protected $layout = 'admin.templates.main';

    public function showIndex() {
        $this->layout->content = View::make('admin.home.index');
    }

}