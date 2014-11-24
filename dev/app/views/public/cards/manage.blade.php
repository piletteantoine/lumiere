@if( Session::has('message') )
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
    <div class="col-xs-12">
        @if( Input::get('s', '') != '' )
        <div class="pull-left">
            <h4>@lang('cards.search.title', [ 'search' => Input::get('s') ])</h4>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('public.cards.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> @lang('cards.form.buttons.new')</a></p>
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('public.cards.manage') }}" type="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" id="s" placeholder="@lang('cards.form.search.placeholder')" value="{{ Input::get('s', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> @lang('cards.form.search.button')</button>
                        </span>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>

<table id="cards" class="table table-bordered">
    <tbody>
    @if( count( $cards ) > 0 )
    @foreach( $cards as $card )
        <tr>
            <th>@lang('cards.manage.table.title')</th>
            <th>@lang('cards.manage.table.description')</th>
            <th>@lang('cards.manage.table.actions')</th>
        </tr>
        <tr>
            <td>{{ $card->title }}</td>
            <td>
                <div class="media">
                  <div class="media-body">
                    {{ $card->description }}
                  </div>
                </div>
            </td>
            <td class="col-md-3">
                <form action="{{ URL::route('public.cards.delete', [$card->id]) }}" method="post">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <a href="{{ URL::route('public.cards.edit', [ 'id' => $card->id ]) }}" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> @lang('cards.buttons.edit')</a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> @lang('cards.buttons.delete')</button>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
    @else
        <tr class="danger">
            <td>@lang('cards.empty')</td>
        </tr>
    @endif
    </tbody>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('public.cards.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> @lang('cards.form.buttons.new')</a></p>
        </div>
    </div>
</div>