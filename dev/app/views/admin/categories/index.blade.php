<h2 class="page-header">Catégories</h2>

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
            <p><a href="{{ URL::route('admin.categories.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nouvelle catégorie</a></p>
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('admin.pages') }}" type="get" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" id="s" placeholder="Rechercher" value="{{ Input::get('s', '') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Rechercher</button>
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
            <th>Titre</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @if( count( $categories ) > 0 )
        @foreach( $categories as $index => $category )
        <tr id="page-{{ $category->id }}">
            <td>{{ $category->title }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <form action="{{ URL::route('admin.categories.delete', [$category->id]) }}" method="post">
                    <div class="btn-group btn-group-block">
                        <a href="{{ URL::route('admin.categories.edit', [$category->id]) }}" class="btn btn-primary btn-sm btn-col-4"><i class="glyphicon glyphicon-edit"></i> <span class="hidden-xs">Modifier</span></a>
                        <button class="btn btn-danger btn-sm btn-col-4"><i class="glyphicon glyphicon-trash"></i> <span class="hidden-xs">Supprimer</span></button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    @else
        <tr class="danger">
            <td colspan="4">Aucune catégorie</td>
        </tr>
    @endif
    </tbody>
    <thead>
        <tr>
            <th colspan="4">
                @if( count( $categories ) > 0 )
                    {{ count($categories) }} catégories dans la base de données.
                @endif
            </th>
        </tr>
    </thead>
</table>

<div class="row">
    <div class="col-xs-12">
        <div class="pull-left">
            <p><a href="{{ URL::route('admin.categories.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></p>
        </div>
    </div>
</div>