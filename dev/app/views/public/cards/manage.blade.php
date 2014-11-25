<div class="wrapper" style="margin-top: 60px">

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

<h2 class="page-header">Gestion de mes fiches de film</h2>
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
                <p><a href="{{ URL::route('public.cards.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></p>
            </div>
            <div class="pull-right">
                <p>
                    <form action="{{ URL::route('public.cards.manage') }}" type="get" class="form-inline">
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @if( count( $cards ) > 0 )
        @foreach( $cards as $card )
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
                                <a href="{{ URL::route('public.cards.edit', [ 'id' => $card->id ]) }}" class="btn btn-primary ajax"><i class="glyphicon glyphicon-edit"></i> Modifier</a>
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

    <div class="row">
        <div class="col-xs-12">
            <div class="pull-left">
                <p><a href="{{ URL::route('public.cards.new') }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Ajouter</a></p>
            </div>
        </div>
    </div>
</div>