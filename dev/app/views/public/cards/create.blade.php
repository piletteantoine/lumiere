@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('public.cards.create') }}" method="post">
    <h4>Ajouter une fiche</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="Titre de l'œuvre">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error has-feedback' : '' }}">
                <label for="name">Description</label>
                <textarea class="form-control" rows="3" name="description" id="description" value="{{ Input::old('description') }}"></textarea>
                @if( $errors->has('description' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('date_publication') ? 'has-error has-feedback' : '' }}">
                <label for="name">Date de sortie</label>
                <input type="number" class="form-control" name="date_publication" id="date_publication" value="{{ date('Y-m-d') }}" placeholder="Date de sortie / publication de l'œuvre">
                @if( $errors->has('date_publication' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_publication') }}</span>
                @endif
            </div>
        </div>
        <input type="number" class="form-control" name="date_production" id="date_production" value="2000" placeholder="Date de production" style="display: none">
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('length') ? 'has-error has-feedback' : '' }}">
                <label for="name">Durée</label>
                <input type="text" class="form-control" name="length" id="length" value="{{ Input::old('length') }}" placeholder="Durée en minutes du film">
                @if( $errors->has('length' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('length') }}</span>
                @endif
            </div>
        </div>
        @if( count( $categories ) > 0 )
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error has-feedback' : '' }}">
                <label for="name">Catégorie</label>
                <select name="category_id" class="form-control">
                @foreach( $categories as $index => $category )
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
                    <option value="0">Aucune catégorie</option>
                </select>
                @if( $errors->has('category_id' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('category_id') }}</span>
                @endif
            </div>
        </div>
        @else
        <input type="hidden" name="category_id" id="category_id" value="0">
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('video_url') ? 'has-error has-feedback' : '' }}">
                <label for="name">URL de la vidéo</label>
                <input type="text" class="form-control" name="video_url" id="video_url" value="{{ Input::old('video_url') }}" placeholder="URL de la vidéo sur une plateforme externe">
                @if( $errors->has('video_url' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('video_url') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="thumb">Vignette</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="thumb" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="poster">Image à la une</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="poster" />
            </div>
        </div>
    </div>
    <hr>
    <h4>Localisation associée</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('adress_street') ? 'has-error has-feedback' : '' }}">
                <label for="name">Adresse</label>
                <input type="text" class="form-control" name="adress_street" id="adress_street" value="{{ Input::old('adress_street') }}" placeholder="Adresse réelle, textuelle">
                @if( $errors->has('adress_street' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('adress_street') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('latitude') ? 'has-error has-feedback' : '' }}">
                        <label for="name">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" value="{{ Input::old('latitude') }}" placeholder="Latitude Google Maps">
                        @if( $errors->has('latitude' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('latitude') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('longitude') ? 'has-error has-feedback' : '' }}">
                        <label for="name">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" value="{{ Input::old('longitude') }}" placeholder="Longitude Google Maps">
                        @if( $errors->has('longitude' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('longitude') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="google-map"></div>
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Valider</button>
    <button type="reset" class="btn">Réinitialiser</button>
</form>