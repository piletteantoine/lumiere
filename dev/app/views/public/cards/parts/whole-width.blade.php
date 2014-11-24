<div class="row">
    <div class="col-xs-12">
        <div class="thumbnail">
            <img src="{{ $card->get_poster(740, 263) }}" alt="@lang('cards.view.invite', ['name'=>$card->title])">
            <div class="caption">
                <h3>
                    <a href="{{ URL::route('public.cards.details', [ 'id' => $card->id ]) }}" title="{{ $card->title }}">{{ $card->title }}</a>
                </h3>
                <p>{{ strlen($card->description) > 253 ? substr($card->description, 0, 250) . '...' : $card->description }}</p>
                <div class="row">
                    <div class="col-xs-4 col-md-4 col-sm-4">
                        <div class="btn-group pull-left">
                            <a href="{{ URL::route('public.cards.details', [ 'id' => $card->id ]) }}" class="btn btn-sm btn-info" role="button"><i class="glyphicon glyphicon-eye-open"></i> @lang('cards.index.view')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>