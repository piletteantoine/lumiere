<h2 class="page-header">@lang('admin/categories.new.title')</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group {{ $errors->has('title') ? 'has-error has-feedback' : '' }}">
                <label for="name">@lang('admin/categories.form.labels.title')</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title', $category->title) }}" placeholder="@lang('admin/categories.form.placeholders.title')">
                @if( $errors->has('title' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">@lang('admin/categories.form.labels.description')</label>
                <textarea class="form-control" name="description" id="description" rows="15">{{ Input::old('description', $category->description) }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <img class="thumbnail" src="{{ $category->get_thumb(64, 64) }}">
        </div>
        <div class="col-md-11">
            <div class="form-group">
                <label for="thumb">@lang('admin/categories.form.labels.thumb')</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="thumb"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="poster">@lang('admin/categories.form.labels.poster')</label>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="poster"/>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <img class="thumbnail" src="{{ $category->get_poster(1000, 300) }}">
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> @lang('admin/categories.form.new.submit')</button>
    <button type="reset" class="btn">@lang('app.reset')</button>
</form>