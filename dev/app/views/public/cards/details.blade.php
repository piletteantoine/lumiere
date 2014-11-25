<h2>{{ $card->title }}</h2>
<img src="{{ $card->get_poster(390, 250) }}" alt="{{ $card->title }}">
<img src="{{ $card->get_thumb(64, 64) }}" alt="{{ $card->title }}">
<p>{{ $card->description }}</p>
<div class="row">
    <div class="col-md-12">
        <h4>Contributeur :</h4>
        <div class="row">
        <p class="text-left"><strong>{{ $author->first_name . ' ' . $author->last_name }}</strong></p>
        <p>{{ $author->bio }}</p>
        <div class="btn-group pull-left">
            <a class="ajax" href="{{ URL::route('public.member', [$author->id]) }}" class="btn btn-sm btn-info" role="button"><i class="glyphicon glyphicon-eye-open"></i> Profil</a>
            <a href="mailto:{{ $author->email }}" class="btn btn-sm btn-primary" role="button"><i class="glyphicon glyphicon-inbox"></i> Email</a>
        </div>
    </div>
</div>
@if( count( $collaborators ) > 0 )
<h4>Participants</h4>
<ul>
    @foreach( $collaborators as $collaborator )
    <li>
    <strong class="name">{{ $collaborator->name }}</strong>
    <span class="role">{{ $collaborator->role }}</span>
    </li>
    @endforeach
</ul>
@endif
<ul>
    <li>Année de production : {{ $card->date_production - 1 }}</li>
    <li>Année de publication : {{ $card->date_publication }}</li>
    <li>Durée : {{ $card->length }} minutes</li>
    @if($card->destination_url != '')
    <li><a href="http://{{ $card->destination_url }}">Plus d'informations</a></li>
    @endif
</ul>