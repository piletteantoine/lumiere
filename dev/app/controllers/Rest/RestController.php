<?php

namespace Rest;

use \Card, \Category, \Lang, \Validator, \Input, \Redirect, \Auth, \Response, \User;

class RestController extends \BaseController {

    public static function showCards($category = null, $lattop = null, $lngtop = null, $latbottom = null, $lngbottom = null, $yearfrom = null, $yearto = null) {
        $cards = Card::where('id', '>', '0');
        $cards->orderBy('id', 'desc');

        if($category != null && $category > 0){
            $cards->where('categories_id', '=', $category);
        } elseif( Input::get('category', '') != '' ) {
            $cards->where('categories_id', '=', Input::get('category', ''));
        }

        return Response::json(array('error' => false, 'cards' => $cards->get()->toArray()), 200);
    }
}