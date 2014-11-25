@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('admin.cards.create') }}" method="post">
    <h4>Ajout d'une fiche de film</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="Titre">
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
            <div class="form-group {{ $errors->has('date_production') ? 'has-error has-feedback' : '' }}">
                <label for="name">Année de production</label>
                <input type="number" class="form-control" name="date_production" id="date_production" value="{{ date('Y-m-d') }}" placeholder="Année de production de l'œuvre audiovisuelle">
                @if( $errors->has('date_production' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_production') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('date_publication') ? 'has-error has-feedback' : '' }}">
                <label for="name">Date de sortie</label>
                <input type="number" class="form-control" name="date_publication" id="date_publication" value="{{ date('Y-m-d', time() + 2592000) }}" placeholder="Année de sortie de l'œuvre audiovisuelle">
                @if( $errors->has('date_publication' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_publication') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('length') ? 'has-error has-feedback' : '' }}">
                <label for="name">Durée</label>
                <input type="text" class="form-control" name="length" id="length" value="{{ Input::old('length') }}" placeholder="Durée">
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
    <hr>
    
    <h4>Géolocalisation</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <label for="geolocation_address">Lieu textuel</label>
                <div class="form-group">
                    <input type="text" class="geolocation" data-name="geolocation" name="geolocation_address" id="geolocation_address" value="{{ Input::old('location') }}">
                </div>
            </div>
            <label for="geolocation_latitude">Coordonnées</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="geolocation_latitude" id="geolocation_latitude" value="{{ Input::old('location_lat') }}">
                        <input type="text" disabled="disabled" name="geolocation_latitude_shown" id="geolocation_latitude_shown" value="{{ Input::old('location_lat') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="geolocation_longitude" id="geolocation_longitude" value="{{ Input::old('location_long') }}">
                        <input type="text" disabled="disabled" name="geolocation_longitude_shown" id="geolocation_longitude_shown" value="{{ Input::old('location_long') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 map-wrap">
            <div class="row">
                <div id="geolocation-google-map" style="height: 240px"></div>
            </div>
            <div class="row" id="geolocation-new-coordinates" style="display: none;">
                <label>Nouvelles coordonnées ?</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" disabled="disabled" id="geolocation_new_latitude" autocomplete="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" disabled="disabled" id="geolocation_new_longitude" autocomplete="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="button button-primary" id="geolocation-use-new" title="Nouvelles coordonnées">Utiliser</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Valider</button>
    <button type="reset" class="btn">Réinitialiser</button>
</form>