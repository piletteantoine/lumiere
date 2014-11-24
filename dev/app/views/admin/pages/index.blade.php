<h2 class="page-header">@lang('admin/pages.title')</h2>

@if( Session::has('message') )
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
    <div class="col-xs-12">
        @if( Input::get('s', '') != '' )
        <div class="pull-left">
            <h4>@lang('admin/pages.search.title', [ 'search' => Input::get('s') ])</h4>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('admin.pages.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> @lang('admin/pages.form.buttons.new')</a></p>
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('admin.pages') }}" type="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" id="s" placeholder="@lang('admin/pages.form.search.placeholder')" value="{{ Input::get('s', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> @lang('admin/pages.form.search.button')</button>
                        </span>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>

<table id="pages" class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>@lang('admin/pages.title')</th>
            <th>@lang('admin/pages.excerpt')</th>
            <th>@lang('admin/pages.published_on')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
    @if( count( $pages ) > 0 )
        @foreach( $pages as $index => $page )
        <tr id="page-{{ $page->id }}">
            <td>{{ $page->title }}</td>
            <td>{{ $page->excerpt }}</td>
            <td>{{ date('d/m/Y H:i', max(strtotime($page->published_on), 0)) }}</td>
            <td>
                <form action="{{ URL::route('admin.pages.delete', [$page->id]) }}" method="post">
                    <div class="btn-group btn-group-block">
                        <a href="{{ URL::route('admin.pages.edit', [$page->id]) }}" class="btn btn-primary btn-sm btn-col-4"><i class="glyphicon glyphicon-edit"></i> <span class="hidden-xs">@lang('admin/pages.form.buttons.edit')</span></a>
                        <button class="btn btn-danger btn-sm btn-col-4"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs">@lang('admin/pages.form.buttons.remove')</span></button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    @else
        <tr class="danger">
            <td colspan="4">@lang('admin/pages.empty')</td>
        </tr>
    @endif
    </tbody>
    <thead>
        <tr>
            <th colspan="4">
                @if( count( $pages ) > 0 )
                    @lang('admin/pages.count', ['count'=>count($pages)])
                @endif
            </th>
        </tr>
    </thead>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('admin.pages.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> @lang('admin/pages.form.buttons.new')</a></p>
        </div>
    </div>
</div>