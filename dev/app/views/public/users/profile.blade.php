<h2 class="page-header">Profile</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                    {{ Auth::user()->get_avatar_url() ? '<img src="' . Auth::user()->get_avatar_url() . '?v=' . time() . '" alt="Avatar" class="img-circle">' : '<span class="glyphicon glyphicon-user icon-size"></span>' }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                            <div class="btn btn-default image-preview-input">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar"/>
                            </div>
                        </span>
                        @if( $errors->has('avatar') )
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group {{ $errors->has('first_name') ? 'has-error has-feedback' : '' }}">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}">
                @if( $errors->has('first_name' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error has-feedback' : '' }}">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}">
                @if( $errors->has('last_name' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
                <label for="email">Email address</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ Input::old('email', $user->email) }}">
                @if( $errors->has('email' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                @if( $errors->has('password' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password_confirm') ? 'has-error has-feedback' : '' }}">
                <label for="password_confirm">Password confirmation</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                @if( $errors->has('password_confirm' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('password_confirm') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('bio') ? 'has-error has-feedback' : '' }}">
                <label for="bio">Bio</label>
                <textarea class="form-control" name="bio" id="bio">{{ Input::old('bio', $user->bio) }}</textarea>
                @if( $errors->has('bio' ) )
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('bio') }}</span>
                @endif
            </div>
        </div>
    </div>
    {{ Form::token() }}
    <button class="btn btn-primary" name="update"><i class="glyphicon glyphicon-ok"></i> Update information</button>
    <button type="reset" class="btn">Reset</button>
</form>