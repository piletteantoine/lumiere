<?php

namespace Admin;

use \View, \Card, \Category, \Lang, \Validator, \Input, \Redirect, \Auth, \Croppa, \User;

class CardsController extends BaseController {

    protected $layout = 'admin.templates.main';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showIndex() {

        $cards = Card::where('id', '>', '0');

        if( Input::get('s', '') != '' ) {
            $cards->where('title', 'LIKE', '%' . Input::get('s') . '%')
                ->orWhere('description', 'LIKE', '%' . Input::get('s') . '%');
        }

        $cards->orderBy('id', 'desc');

        $this->layout->content = View::make('admin.cards.index');
        $this->layout->content->cards = $cards->get();
        $this->layout->content_title = Lang::get('cards.manage.title');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function showNew() {
        $categories = Category::all();

        $this->layout->content = View::make('admin.cards.create');
        $this->layout->content->categories = $categories;
        $this->layout->content_title = Lang::get('cards.new.title');
    }

    public function postCreate() {

        $data = Input::all();
        $data['user_id'] = Auth::user()->id;

        $validator = Validator::make($data, Card::$rules );

        if( $validator->passes() ) {

            $card = new Card();
            $card->fill(
                array(
                    'title'                 => Input::get('title'),
                    'description'           => Input::get('description'),
                    'category_id'           => Input::get('category_id'),
                    'date_production'       => Input::get('date_production'),
                    'date_publication'      => Input::get('date_publication'),
                    'categories_id'         => Input::get('category_id'),
                    'location'              => Input::get('geolocation_address'),
                    'location_lat'          => Input::get('geolocation_latitude'),
                    'location_long'         => Input::get('geolocation_longitude'),
                )
            )->save();

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

            return Redirect::back()->with('message', Lang::get('cards.new.message', array('title' => Input::get('title'))));
        } else {
            return Redirect::back()
                ->with('message', Lang::get('cards.new.error'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function showEdit($id) {
        $card = Card::find($id);
        $categories = Category::all();
        $author = User::find($card->user_id);

        // If no item in database
        if(empty($card) || empty($card->id))
            return Redirect::route('public.cards')
                ->with('message', Lang::get('cards.edit.inexistant'));

        $category = Category::find($card->categories_id);
        //var_dump($category); die();

        if( ! ( $author->id == Auth::user()->id || Auth::user()->role()->first()->name_tag == 'admin' ) )
            return Redirect::back()->with('message', Lang::get('cards.edit.unauthorized'));

        $this->layout->content = View::make('admin.cards.edit');
        $this->layout->content->card = $card;
        $this->layout->content->categories = $categories;
        $this->layout->content->category = $category;
        $this->layout->sidebar = View::make('public.cards.sidebars.edit')->with('card', $card);
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

        if( $validator->passes() ) {
            $card->fill(
                array(
                    'title'                 => Input::get('title'),
                    'description'           => Input::get('description'),
                    'category_id'           => Input::get('category_id'),
                    'date_production'       => Input::get('date_production'),
                    'date_publication'      => Input::get('date_publication'),
                    'categories_id'         => Input::get('category_id'),
                    'location'              => Input::get('geolocation_address'),
                    'location_lat'          => Input::get('geolocation_latitude'),
                    'location_long'         => Input::get('geolocation_longitude'),
                )
            )->save();

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

    public function postDelete($id = 0) {
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
}