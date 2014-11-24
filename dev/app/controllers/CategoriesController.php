<?php

class CategoriesController extends BaseController {

    protected $layout = 'public.templates.main';

    public function showDetails($id) {
    	$category = Category::find($id);
        
        // If no item in database
        if(empty($category) || empty($category->id))
            return Redirect::route('home')
                ->with('message', Lang::get('admin/categories.inexistant'));

	    $cards = Card::where('category_id', '=', $id)->get();

        $this->layout->content = View::make('public.categories.details');
        $this->layout->content->category = $category;
        $this->layout->content->cards = $cards;
        $this->layout->content_title = Lang::get('categories.details.title', array('category' => $category->title));

    }

}