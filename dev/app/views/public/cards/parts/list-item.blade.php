<div class="col-xs-4 col-md-4 col-sm-4">
    <div class="thumbnail">
        <a href="{{ URL::route('public.cards.details', [ 'id' => $card->id ]) }}" title="{{ $card->title }}">
            <img src="{{ $card->get_poster(220, 161) }}" alt="@lang('cards.view.invite', ['name'=>$card->title])">
        </a>
        <div class="caption">
            <h3 style="height: 60px">
                <a href="{{ URL::route('public.cards.details', [ 'id' => $card->id ]) }}" title="{{ $card->title }}">{{ $card->title }}</a>
            </h3>
            <hr>
            <div style="height: 100px">{{ strlen($card->description) > 123 ? substr($card->description, 0, 120) . '...' : $card->description }}</div>
            <hr>
            <p>@lang('cards.index.current_progress', ['current' => '1.270', 'max' => '<strong>12.765</strong>'])</p>
            <div class="progress progress-striped active">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
            </div>
        </div>
        <div class="btn-group btn-group-justified">
            <a href="#" class="btn btn-sm btn-danger" role="button"><i class="glyphicon glyphicon-heart"></i> @lang('cards.index.like')</a>
            <a href="#" class="btn btn-sm btn-primary" role="button"><i class="glyphicon glyphicon-credit-card"></i> @lang('cards.index.fund')</a>
            <a href="{{ URL::route('public.cards.details', [ 'id' => $card->id ]) }}" class="btn btn-sm btn-info" role="button"><i class="glyphicon glyphicon-eye-open"></i> @lang('cards.index.view')</a>
        </div>
    </div>
</div>