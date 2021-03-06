<h2>Register</h2>
<form accept-charset="UTF-8" role="form" action="{{ URL::route('register') }}" method="post">
    <fieldset>
        <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
            <label for="email">Email</label>
            <input class="form-control" placeholder="yourmail@example.com" name="email" type="text" value="{{ Input::old('email') }}">
            @if( $errors->has('email' ) )
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
            <label for="password">Mot de passe</label>
            <input class="form-control" placeholder="Mot de passe" name="password" type="password" value="">
            @if( $errors->has('password' ) )
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error has-feedback' : '' }}">
            <label for="password_confirmation">Retapez votre mot de passe</label>
            <input class="form-control" placeholder="Mot de passe" name="password_confirmation" type="password" value="">
            @if( $errors->has('password_confirmation' ) )
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('first_name') ? 'has-error has-feedback' : '' }}">
            <label for="first_name">Prénom</label>
            <input class="form-control" placeholder="Prénom" name="first_name" type="text" value="{{ Input::old('first_name') }}">
            @if( $errors->has('first_name' ) )
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="help-block">{{ $errors->first('first_name') }}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('last_name') ? 'has-error has-feedback' : '' }}">
            <label for="last_name">Nom</label>
            <input class="form-control" placeholder="Nom" name="last_name" type="text" value="{{ Input::old('last_name') }}">
            @if( $errors->has('last_name' ) )
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span class="help-block">{{ $errors->first('last_name') }}</span>
            @endif
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="action" value="register">Inscription</button>
    </fieldset>
</form>