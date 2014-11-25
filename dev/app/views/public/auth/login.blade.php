<h2>Connexion</h2>
<form accept-charset="UTF-8" role="form" action="{{ URL::route('login') }}" method="post">
@if (Session::has('login_errors'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    Nom d'utilisateur ou mot de passe incorrect
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
                <input name="remember" type="checkbox" value="Se souvenir de moi"> Se souvenir de moi
            </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" name="action" value="login">Connexion</button>
    </fieldset>
</form>