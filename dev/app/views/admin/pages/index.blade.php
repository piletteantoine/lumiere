<h2 class="page-header">Pages de CMS</h2>

@if( Session::has('message') )
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<div class="row">
    <div class="col-xs-12">
        @if( Input::get('s', '') != '' )
        <div class="pull-left">
            <h4>Recherche : {{ Input::get('s') }}</h4>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('admin.pages.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nouveau</a></p>
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('admin.pages') }}" type="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" id="s" placeholder="Terme de recherche" value="{{ Input::get('s', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Rechercher</button>
                        </span>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>

<table id="pages" class="table table-bordered">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Résumé</th>
            <th>Publié le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @if( count( $pages ) > 0 )
        @foreach( $pages as $index => $page )
        <tr id="page-{{ $page->id }}">
            <td style="width: 200px">{{ $page->title }}</td>
            <td>{{ $page->excerpt }}</td>
            <td style="width: 100px">{{ date('d/m/Y H:i', max(strtotime($page->published_on), 0)) }}</td>
            <td style="width: 200px">
                <form action="{{ URL::route('admin.pages.delete', [$page->id]) }}" method="post">
                    <div class="btn-group">
                        <a href="{{ URL::route('admin.pages.edit', [$page->id]) }}" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Modifier</a>
                        <button class="btn btn-danger" style="width: auto"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    @else
        <tr class="danger">
            <td colspan="4">Aucune page disponible</td>
        </tr>
    @endif
    </tbody>
    <thead>
        <tr>
            <th colspan="4">
                @if( count( $pages ) > 0 )
                    {{ count($pages) }} pages en base de données.
                @endif
            </th>
        </tr>
    </thead>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('admin.pages.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></p>
        </div>
    </div>
</div>