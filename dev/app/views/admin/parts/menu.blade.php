<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('admin.home') }}"><img src="{{ asset('assets/images/logo_Lumière-01.png') }}" alt="" height="40px"></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li {{ $route_parent == 'admin/home' ? 'class="active"' : '' }}><a href="{{ URL::route('admin.home') }}">@lang('admin/menu.home')</a></li>
                <li class="dropdown {{ $route_parent == 'admin/pages' ? 'active' : '' }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::route('admin.pages') }}">@lang('admin/menu.pages') <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::route('admin.pages') }}">@lang('admin/menu.pages.list')</a></li>
                        <li><a href="{{ URL::route('admin.pages.new') }}">@lang('admin/menu.pages.new')</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ $route_parent == 'admin/cards' ? 'active' : '' }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::route('admin.cards') }}">@lang('admin/menu.cards') <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ URL::route('admin.cards') }}">@lang('admin/menu.cards.list')</a></li>
                        <li><a href="{{ URL::route('admin.cards.new') }}">@lang('admin/menu.cards.new')</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ URL::route('home') }}">Back to the site</a></li>
            </ul>
        </div>
    </div>
</div>