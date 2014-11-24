<h2>@lang('auth/login.title')</h2>
<form accept-charset="UTF-8" role="form" action="{{ URL::route('login') }}" method="post">
@if (Session::has('login_errors'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    Username or password incorrect.
</div>
@endif
    <fieldset>
        <div class="form-group">
            <input class="form-control" placeholder="yourmail@example.com" name="email" type="text">
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
        </div>
        <div class="checkbox">
            <label>
                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
            </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" name="action" value="login">Login</button>
    </fieldset>
</form>