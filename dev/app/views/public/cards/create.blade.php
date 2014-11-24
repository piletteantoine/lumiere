@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('public.cards.create') }}" method="post">
    <h4>@lang('cards.form.labels.introduction')</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.title')</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="@lang('cards.form.placeholders.title')">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.description')</label>
                <textarea class="form-control" rows="3" name="description" id="description" value="{{ Input::old('description') }}"></textarea>
                @if( $errors->has('description' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('date_publication') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.date_publication')</label>
                <input type="number" class="form-control" name="date_publication" id="date_publication" value="{{ date('Y-m-d') }}" placeholder="@lang('cards.form.placeholders.date_publication')">
                @if( $errors->has('date_publication' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_publication') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('date_production') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.date_production')</label>
                <input type="number" class="form-control" name="date_production" id="date_production" value="{{ date('Y-m-d', time() + 2592000) }}" placeholder="@lang('cards.form.placeholders.date_production')">
                @if( $errors->has('date_production' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('date_production') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('length') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.length')</label>
                <input type="text" class="form-control" name="length" id="length" value="{{ Input::old('length') }}" placeholder="@lang('cards.form.placeholders.length')">
                @if( $errors->has('length' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('length') }}</span>
                @endif
            </div>
        </div>
        @if( count( $categories ) > 0 )
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('category_id') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.category')</label>
                <select name="category_id" class="form-control">
                @foreach( $categories as $index => $category )
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
                    <option value="0">@lang('cards.form.no_category')</option>
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
                <label for="name">@lang('cards.form.labels.video_url')</label>
                <input type="text" class="form-control" name="video_url" id="video_url" value="{{ Input::old('video_url') }}" placeholder="@lang('cards.form.placeholders.video_url')">
                @if( $errors->has('video_url' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('video_url') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="thumb">@lang('cards.form.labels.thumb')</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="thumb" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="poster">@lang('cards.form.labels.poster')</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="poster" />
            </div>
        </div>
    </div>
    <hr>
    <h4>@lang('cards.form.labels.location')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('adress_street') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('cards.form.labels.adress_street')</label>
                <input type="text" class="form-control" name="adress_street" id="adress_street" value="{{ Input::old('adress_street') }}" placeholder="@lang('cards.form.placeholders.adress_street')">
                @if( $errors->has('adress_street' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('adress_street') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('latitude') ? 'has-error has-feedback' : '' }}">
                        <label for="name">@lang('cards.form.labels.latitude')</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" value="{{ Input::old('latitude') }}" placeholder="@lang('cards.form.placeholders.latitude')">
                        @if( $errors->has('latitude' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('latitude') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('longitude') ? 'has-error has-feedback' : '' }}">
                        <label for="name">@lang('cards.form.labels.longitude')</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" value="{{ Input::old('longitude') }}" placeholder="@lang('cards.form.placeholders.longitude')">
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
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> @lang('cards.form.new.submit')</button>
    <button type="reset" class="btn">@lang('app.reset')</button>
</form>