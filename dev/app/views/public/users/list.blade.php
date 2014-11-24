@if( Session::has('message') )
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
    <div class="col-xs-12">
        @if( Input::get('s', '') != '' )
        <div class="pull-left">
            <h4>@lang('users.search.title', [ 'search' => Input::get('s') ])</h4>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('public.members') }}" type="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" id="s" placeholder="@lang('users.form.search.placeholder')" value="{{ Input::get('s', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> @lang('users.form.search.button')</button>
                        </span>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>

<table id="users" class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>@lang('users.list.table.name')</th>
            <th>@lang('users.list.table.cards')</th>
        </tr>
    </thead>
    <tbody>
    @if( count( $users ) > 0 )
        @foreach( $users as $index => $user )
        <tr id="user-{{ $user->id }}">
            <td><a href="{{ URL::route('public.member', [ 'id' => $user->id ]) }}">{{ $user->first_name . ' ' . $user->last_name }}</a></td>
            <td>{{ count( $user->cards() ) }}</td>
        </tr>
        @endforeach
    @else
        <tr class="danger">
            <td colspan="3">@lang('users.empty')</td>
        </tr>
    @endif
    </tbody>
</table>