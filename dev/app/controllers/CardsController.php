<?php

class CardsController extends BaseController {

    protected $layout = 'public.templates.main';

    public function __construct() {
        $this->scripts[] = 'http://maps.googleapis.com/maps/api/js?sensor=false&#038;ver=4.0-alpha';
        $this->scripts[] = '/assets/js/cards.js';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showDetails($id) {
        $card = Card::find($id);

        // If no item in database
        if(empty($card) || empty($card->id))
            return Redirect::route('home')
                ->with('message', Lang::get('cards.inexistant'));

        $author = User::find($card->user_id);

        $this->layout->content = View::make('public.cards.details');
        $this->layout->content->card = $card;
        $this->layout->content->author = $author;
        $this->layout->content_title = $card->title;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function showNew()
    {
        $categories = Category::all();

        $this->layout->content = View::make('public.cards.create');
        $this->layout->content->categories = $categories;
        $this->layout->content_title = Lang::get('cards.new.title');
    }

    public function postCreate()
    {
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        $validator = Validator::make( $data, Card::$rules );

        if( $validator->passes() ) {

            $card = Card::create( $data );

            $poster = Input::file('poster', null);
            if( null !== $poster ) {
                Croppa::delete('uploads/cards/posters/' . $id . '.png');
                $destination_path = 'uploads/cards/posters';
                $file_name = $category->id;

                $path_parts = explode('.', $poster->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $poster_passes = Input::file('poster')->move($destination_path, $file_name . '.png');
            } else {
                $poster_passes = true;
            }

            if(is_bool($poster_passes) && $poster_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('cards.poster.bad_upload_error'))
                    ->withInput();
            }

            $thumb = Input::file('thumb', null);
            if( null !== $thumb ) {
                Croppa::delete('uploads/cards/thumbs/' . $id . '.png');
                $destination_path = 'uploads/cards/thumbs';
                $file_name = $category->id;

                $path_parts = explode('.', $thumb->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $thumb_passes = Input::file('thumb')->move($destination_path, $file_name . '.png');
            } else {
                $thumb_passes = true;
            }

            if(is_bool($thumb_passes) && $thumb_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('cards.thumb.bad_upload_error'))
                    ->withInput();
            }

            return Redirect::back()->with('message', Lang::get('cards.new.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('cards.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function showEdit($id) {
        $card   = Card::find($id);
        $categories = Category::all();
        
        // If no item in database
        if(empty($card) || empty($card->id))
            return Redirect::route('public.cards')
                ->with('message', Lang::get('cards.edit.inexistant'));

        $category = Category::find($card->categories_id);

        if( ! ( $card->author->id == Auth::user()->id || Auth::user()->role()->first()->name_tag == 'admin' ) )
            return Redirect::back()->with('message', Lang::get('cards.edit.unauthorized'));

        $this->layout->content = View::make('public.cards.edit');
        $this->layout->content->card = $card;
        $this->layout->content->categories = $categories;
        $this->layout->content->category = $category;
    }

    public function postUpdate($id) {
        $card = Card::find($id);

        // If no item in database
        if(empty($card) || empty($card->id))
            return Redirect::route('public.cards')
                ->with('message', Lang::get('cards.edit.inexistant'));

        if( ! ( $card->author->id == Auth::user()->id || Auth::user()->role()->first()->name_tag == 'admin' ) )
            return Redirect::back()->with('message', Lang::get('cards.edit.unauthorized'));

        $validator = Validator::make( Input::all(), Card::$rules );

        $data = Input::all();
        $data['length'] = intval(Input::get('length', 0) * 100 );

        if( $validator->passes() ) {
            $card->fill($data)->save();

            $poster = Input::file('poster', null);
            if( null !== $poster ) {
                Croppa::delete('uploads/cards/posters/' . $id . '.png');
                $destination_path = 'uploads/cards/posters';
                $file_name = $card->id;

                $path_parts = explode('.', $poster->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $poster_passes = Input::file('poster')->move($destination_path, $file_name . '.png');
            } else {
                $poster_passes = true;
            }

            if(is_bool($poster_passes) && $poster_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('cards.poster.bad_upload_error'))
                    ->withInput();
            }

            $thumb = Input::file('thumb', null);
            if( null !== $thumb ) {
                Croppa::delete('uploads/cards/thumbs/' . $id . '.png');
                $destination_path = 'uploads/cards/thumbs';
                $file_name = $card->id;

                $path_parts = explode('.', $thumb->getClientOriginalName() );
                $ext = $path_parts[count($path_parts) - 1];

                $thumb_passes = Input::file('thumb')->move($destination_path, $file_name . '.png');
            } else {
                $thumb_passes = true;
            }

            if(is_bool($thumb_passes) && $thumb_passes == false){
                return Redirect::back()
                    ->with('message', Lang::get('cards.thumb.bad_upload_error'))
                    ->withInput();
            }

            return Redirect::back()->with('message', Lang::get('cards.edit.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('cards.edit.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function postDelete($id) {
        $card = Card::find($id);

        // If no item in database
        if(empty($card) || empty($card->id))
            return Redirect::route('public.cards')
                ->with('message', Lang::get('cards.edit.inexistant'));

        if( ! ( $card->author->id == Auth::user()->id || Auth::user()->role()->first()->name_tag == 'admin' ) )
            return Redirect::back()->with('message', Lang::get('public.cards.delete.unauthorized'));

        try {
            $card->delete();
        } catch(Exception $e){
            return Redirect::back()->with('message', Lang::get('cards.delete.error'))->withInput();
        }

        return Redirect::back()->with('message', Lang::get('cards.delete.message', array('title' => Input::get('title'))));
    }

    public function showManage() {
        $cards = Card::where('user_id', Auth::user()->id);

        if( Input::get('s', '') != '' ) {
            $cards->where('title', 'LIKE', '%' . Input::get('s') . '%')
                ->orWhere('description', 'LIKE', '%' . Input::get('s') . '%');
        }

        $cards->orderBy('id', 'desc');

        $this->layout->content = View::make('public.cards.manage');
        $this->layout->content->cards = $cards->get();;
        $this->layout->content_title = Lang::get('cards.manage.title');
    }
}