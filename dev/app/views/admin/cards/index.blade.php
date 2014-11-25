<h2 class="page-header">Fiches de films</h2>

@if( Session::has('message') )
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        $('#cards').DataTable({
            'searching': false,
             "language": {
                "paginate": {
                    'first': '<<',
                    'last': '>>',
                    'next': '>',
                    'previous': '<'
                }
            }
        });
    });
</script>

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
            <p><a href="{{ URL::route('admin.cards.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter une fiche</a></p>
        </div>
        <div class="pull-right">
            <p>
                <form action="{{ URL::route('admin.cards') }}" type="get" class="form-inline">
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

<table id="cards" class="table table-bordered">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @if( count( $cards ) > 0 )
    @foreach( $cards as $card )
        <tr>
            <td>{{ $card->title }}</td>
            <td>{{ $card->description }}</td>
            <td class="col-md-3">
                <form action="{{ URL::route('admin.cards.delete', [$card->id]) }}" method="post">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <a href="{{ URL::route('admin.cards.edit', [ 'id' => $card->id ]) }}" class="ajax btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Modifier</a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Supprimer</button>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    @endforeach
    @else
        <tr class="danger">
            <td>Aucune fiche disponible</td>
        </tr>
    @endif
    </tbody>
</table>