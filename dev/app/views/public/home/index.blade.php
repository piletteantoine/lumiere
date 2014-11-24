@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

@if( count( $cards ) > 0 )
    @foreach( $cards as $index => $card )
        @if($index == 0)
            @include('public.cards.parts.whole-width')
        @else
            @if($index == 1)
            <div class="row">
            @endif

            @include('public.cards.parts.list-item')

            @if($index % 3 == 0)
            </div>
            <div class="row">
            @endif

            @if($index == count($cards))
            </div>
            @endif

        @endif
    @endforeach
@endif
</div>