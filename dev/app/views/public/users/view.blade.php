<h2 class="page-header">@lang('users.member_title', [ 'name' => $user->first_name . ' ' . $user->last_name ])</h2>

@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div class="row">
    <div class="col-md-4">
        <p class="text-center">
        {{ $user->get_avatar_url() ? '<img src="' . $user->get_avatar_url() . '?v=' . time() . '" alt="Avatar" class="img-circle">' : '<span class="glyphicon glyphicon-user icon-size"></span>' }}
        </p>
    </div>
    <div class="col-md-8">
        <table class="table table-user-profile">
            <tr>
                <th>Email address</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Bio</th>
                <td>{{ $user->bio }}</td>
            </tr>
        </table>
    </div>
</div>
