<h2 class="page-header">Nouvelle page CMS</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('admin.pages.create') }}" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="Titre de la page">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('published_on_date') ? 'has-error has-feedback' : '' }}">
                        <label for="published_on_date">Date de publication</label>
                        <input class="form-control" type="date" name="published_on_date" id="published_on_date" value="{{ date('Y-m-d') }}" placeholder="aaaa-mm-dd">
                        @if( $errors->has('published_on_date' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('published_on_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('published_on_time') ? 'has-error has-feedback' : '' }}">
                        <label for="published_on_time">Heure de publication</label>
                        <input type="time" class="form-control" name="published_on_time" id="published_on_time" value="{{ Input::old('published_on_time', date('H:i')) }}" placeholder="07:00">
                        @if( $errors->has('published_on_time' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('published_on_time') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="checkbox" name="use_current_time" id="use_current_time" />
                        <label for="use_current_time">Utiliser la date et l'heure actuelles</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="content">Résumé</label>
                <textarea class="form-control" name="excerpt" id="excerpt" rows="5"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">Contenu de la page</label>
                <textarea class="form-control" name="content" id="content" rows="15">{{ Input::old('content') }}</textarea>
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Ajouter</button>
    <button type="reset" class="btn">Réinitialiser</button>
</form>