<h2 class="page-header">@lang('admin/pages.new.title')</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ URL::route('admin.pages.create') }}" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('admin/pages.form.labels.title')</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title') }}" placeholder="@lang('admin/pages.form.placeholders.title')">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('published_on_date') ? 'has-error has-feedback' : '' }}">
                        <label for="published_on_date">@lang('admin/pages.form.labels.published_on_date')</label>
                        <input class="form-control" type="number" name="published_on_date" id="published_on_date" value="{{ date('Y-m-d') }}" placeholder="aaaa-mm-dd">
                        @if( $errors->has('published_on_date' ) )
                        <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        <span class="help-block">{{ $errors->first('published_on_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group {{ $errors->has('published_on_time') ? 'has-error has-feedback' : '' }}">
                        <label for="published_on_time">@lang('admin/pages.form.labels.published_on_time')</label>
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
                        <label for="use_current_time">@lang('admin/pages.form.labels.use_current_time')</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="content">@lang('admin/pages.form.labels.excerpt')</label>
                <textarea class="form-control" name="excerpt" id="excerpt" rows="5"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">@lang('admin/pages.form.labels.content')</label>
                <textarea class="form-control" name="content" id="content" rows="15">{{ Input::old('content') }}</textarea>
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> @lang('admin/pages.form.new.submit')</button>
    <button type="reset" class="btn">@lang('app.reset')</button>
</form>