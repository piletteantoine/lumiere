@if( 'create_card' == Input::old('action', '') && Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('admin.cards.update', ['id' => $card->id]) }}" method="post"  enctype="multipart/form-data">
    <h4>Édition d'une fiche</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">Titre</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title', $card->title) }}" placeholder="Titre">
                @if( 'create_card' == Input::old('action', '') && $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('description') ? 'has-error has-feedback' : '' }}">
                <label for="name">Description</label>
                <textarea class="form-control" rows="3" name="description" id="description">{{ Input::old('description', $card->description) }}</textarea>
                @if( 'create_card' == Input::old('action', '') && $errors->has('description' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <img class="thumbnail" src="{{ $card->get_thumb(64, 64) }}">
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="thumb">Vignette</label>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="thumb"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="poster">Image à la une</label>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="poster"/>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <img class="thumbnail" src="{{ $card->get_poster(740, 263) }}">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('date_start') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.date_start')</label>
                <input type="number" class="form-control" name="date_start" id="date_start" value="{{ Input::old('date_start', $card->date_start) }}" placeholder="@lang('cards.form.placeholders.date_start')">
                @if( 'create_card' == Input::old('action', '') && $errors->has('date_start' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_start') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('date_end') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.date_end')</label>
                <input type="number" class="form-control" name="date_end" id="date_end" value="{{ Input::old('date_start', $card->date_start) }}" placeholder="@lang('cards.form.placeholders.date_end')">
                @if( 'create_card' == Input::old('action', '') && $errors->has('date_end' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_end') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('length') ? 'has-error has-feedback' : '' }}">
                <label for="name">Durée</label>
                <input type="text" class="form-control" name="length" id="length" value="{{ Input::old('length', $card->length) }}" placeholder="Durée">
                @if( 'create_card' == Input::old('action', '') && $errors->has('length' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('length') }}</span>
                @endif
            </div>
        </div>
        @if( count( $categories ) > 0 )
        <div class="col-md-12">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('category_id') ? 'has-error has-feedback' : '' }}">
                <label for="name">Catégorie</label>
                <select name="category_id" class="form-control">
                @foreach( $categories as $index => $local_category )
                    <option value="{{ $category->id }}" {{ $category->id == $local_category->id ? 'selected="selected"' : '' }}>{{ $category->title }}</option>
                @endforeach
                </select>
                @if( 'create_card' == Input::old('action', '') && $errors->has('category_id' ) )
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
    <h4>@lang('cards.form.labels.item')</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('target_title') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.target_title')</label>
                <input type="text" class="form-control" name="target_title" id="target_title" value="{{ Input::old('target_title', $card->target_title) }}" placeholder="@lang('cards.form.placeholders.target_title')">
                @if( 'create_card' == Input::old('action', '') && $errors->has('target_title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('target_title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('item_description') ? 'has-error has-feedback' : '' }}">
                <label for="name">Description</label>
                <textarea class="form-control" rows="3" name="item_description" id="item_description">{{ Input::old('item_description', $card->item_description) }}</textarea>
                @if( 'create_card' == Input::old('action', '') && $errors->has('item_description' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('item_description') }}</span>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <h4>@lang('cards.form.labels.recipient')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('target_adress_street') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.target_adress_street')</label>
                <input type="text" class="form-control" name="target_adress_street" id="target_adress_street" value="{{ Input::old('target_adress_street', $card->target_adress_street) }}" placeholder="@lang('cards.form.placeholders.target_adress_street')">
                @if( 'create_card' == Input::old('action', '') && $errors->has('target_adress_street' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('target_adress_street') }}</span>
                @endif
                <label for="name">@lang('cards.form.labels.target_adress_street2')</label>
                <input type="text" class="form-control" name="target_adress_street2" id="target_adress_street2" value="{{ Input::old('target_adress_street2', $card->target_adress_street2) }}" placeholder="@lang('cards.form.placeholders.target_adress_street2')">
                @if( 'create_card' == Input::old('action', '') && $errors->has('target_adress_street2' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('target_adress_street2') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('target_adress_zip') ? 'has-error has-feedback' : '' }}">
                        <label for="name">@lang('cards.form.labels.target_adress_zip')</label>
                        <input type="text" class="form-control" name="target_adress_zip" id="target_adress_zip" value="{{ Input::old('target_adress_zip', $card->target_adress_zip) }}" placeholder="@lang('cards.form.placeholders.target_adress_zip')">
                        @if( 'create_card' == Input::old('action', '') && $errors->has('target_adress_zip' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('target_adress_zip') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('target_adress_city') ? 'has-error has-feedback' : '' }}">
                        <label for="name">@lang('cards.form.labels.target_adress_city')</label>
                        <input type="text" class="form-control" name="target_adress_city" id="target_adress_city" value="{{ Input::old('target_adress_city', $card->target_adress_city) }}" placeholder="@lang('cards.form.placeholders.target_adress_city')">
                        @if( 'create_card' == Input::old('action', '') && $errors->has('target_adress_city' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('target_adress_city') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('target_adress_country') ? 'has-error has-feedback' : '' }}">
                        <label for="name">@lang('cards.form.labels.target_adress_country')</label>
                        <input type="text" class="form-control" name="target_adress_country" id="target_adress_country" value="{{ Input::old('target_adress_country', $card->target_adress_country) }}" placeholder="@lang('cards.form.placeholders.target_adress_country')">
                        @if( 'create_card' == Input::old('action', '') && $errors->has('target_adress_country' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('target_adress_country') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ 'create_card' == Input::old('action', '') && $errors->has('item_target_description') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.target_description')</label>
                <textarea class="form-control" rows="8" name="target_description" id="target_description">{{ Input::old('target_description', $card->target_description) }}</textarea>
                @if( 'create_card' == Input::old('action', '') && $errors->has('target_description' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('target_description') }}</span>
                @endif
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button type="submit" name="action" value="create_pledge" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Finir l'édition</button>
    <button type="reset" class="btn">Réinitialiser</button>
</form>