<h2 class="page-header">Ajouter une catégorie</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('admin.categories.create') }}" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="title">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="Titre de la catégorie / du genre">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="15">{{ Input::old('description') }}</textarea>
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Valider</button>
    <button type="reset" class="btn">Réinitialiser</button>
</form>