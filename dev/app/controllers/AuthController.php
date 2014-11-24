<?php

class AuthController extends BaseController {

    protected $layout = 'public.templates.auth';

    public function showIndex() {
        $this->layout->content = View::make('public.auth.login');
    }

    public function postLogin() {
        if( Auth::attempt( array( 'email' => Input::get('email'), 'password' => Input::get('password') ) ) ) {
            return Redirect::intended(route('admin.home'));
        } else {
            return Redirect::guest('login')
                ->withInput()
                ->with('login_errors', true);
        }
    }

    public function showLogout() {
        Auth::logout();

        return Redirect::route('home');
    }

    public function showNew() {
        $this->layout->content = View::make('public.auth.register');
    }

    public function postCreate() {
        $validator = Validator::make( Input::all(), User::$rules );
        if( $validator->passes() ) {
            $user = new User();
            $user->email      = Input::get('email');
            $user->password   = Hash::make(Input::get('password'));
            $user->first_name = Input::get('first_name');
            $user->last_name  = Input::get('last_name');
            $user->role_id    = 1;
            $user->save();

            Auth::attempt( array( 'email' => Input::get('email'), 'password' => Input::get('password' ) ) );
            return Redirect::route('home')->withMessage('Thanks for your interest! You have now access to the members area.');

        } else {
            return Redirect::route('register')->withErrors($validator)->withInput();
        }
    }

}