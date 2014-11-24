<?php

class HomeController extends BaseController {

    protected $layout = 'public.templates.main';

    public function showIndex() {
	    $cards = Card::all();

        $this->layout->content = View::make('public.home.index');
        $this->layout->content->cards = $cards;
        $this->layout->content_title = Lang::get('cards.list');

    }

}