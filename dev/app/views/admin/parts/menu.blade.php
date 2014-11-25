<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="wrapper">
        <div class="menu container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logotype" href="{{ URL::route('home') }}"><img src="{{ asset('assets/img/lumiere-logo.png') }}" alt="" height="40px"></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li {{ $route_parent == 'admin/home' ? 'class="active"' : '' }}><a href="{{ URL::route('admin.home') }}">Admin.</a></li>
                    <li class="dropdown {{ $route_parent == 'admin/pages' ? 'active' : '' }}">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::route('admin.pages') }}">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('admin.pages') }}">Liste des pages</a></li>
                            <li><a href="{{ URL::route('admin.pages.new') }}">Nouvelle page</a></li>
                        </ul>
                    </li>
                    <li class="dropdown {{ $route_parent == 'admin/cards' ? 'active' : '' }}">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::route('admin.cards') }}">Fiches <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::route('admin.cards') }}">Liste des fiches</a></li>
                            <li><a href="{{ URL::route('admin.cards.new') }}">Nouvelle fiche</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ URL::route('home') }}">Voir le site &rarr;</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>