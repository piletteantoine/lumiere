<?php

namespace Rest;

use \Card, \Category, \Lang, \Validator, \Input, \Redirect, \Auth, \Response, \User;

class RestController extends \BaseController {

    public static function showCards($category = null, $lattop = null, $lngtop = null, $latbottom = null, $lngbottom = null, $yearfrom = null, $yearto = null) {
        $cards = Card::where('id', '>', '0');
        $cards->orderBy('id', 'desc');

        // Category
        if( Input::get('category', '') != '' ) $category = Input::get('category', '');
        if($category != null && $category > 0) $cards->where('categories_id', '=', $category);
        
        if( Input::get('yearfrom', '') != '' ) $yearfrom = Input::get('yearfrom', '');
        if($yearfrom != null && $yearfrom > 0){
            $cards->where('date_production', '>=', $yearfrom);
        }

        if( Input::get('yearto', '') != '' ){
            $yearto = Input::get('yearto', '');
            if($yearfrom == null || $yearfrom < 0){
                $yearfrom = $yearto;
                $cards->where('date_production', '=', $yearfrom);                
            } else {
                $cards->where('date_production', '<=', $yearto);
            }
        }

        $movietype = Input::get('movietype', '');
        if( $movietype != '' && in_array($movietype, array('short', 'long'))){
            if($movietype == 'short'){
                $cards->where('length', '<', 45);
            } else {
                $cards->where('length', '>', 45);
            }
        }        

        return Response::json(array('error' => false, 'cards' => $cards->get()->toArray()), 200);
    }
}