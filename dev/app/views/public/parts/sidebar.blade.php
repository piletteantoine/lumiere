<div class="panel panel-info">
  <div class="panel-heading">Quick links</div>
  <div class="list-group">
    <a class="list-group-item active" href="{{ URL::route('public.cards.new') }}"><span style="display: inline-block; width: 30px" class="glyphicon glyphicon-plus"></span> @lang('menu.cards.new')</a>
    <a class="list-group-item" href="{{ URL::route('public.cards.manage') }}"><span style="display: inline-block; width: 30px" class="glyphicon glyphicon-th-list"></span>Manage your cards</a>
    <a class="list-group-item" href="{{ URL::route('profile') }}"><span style="display: inline-block; width: 30px" class="glyphicon glyphicon-user"></span>@lang('menu.edit_profile')</a>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">@lang('sidebar.categories.title')</div>
  <!-- List group -->
  <div class="list-group">
    @if( ! is_null( $categories ) && ! empty( $categories ) )
        @foreach( $categories as $category )
        <a href="{{ URL::route('public.categories.details', [ 'id' => $category->id ]) }}" class="list-group-item">
            <div class="media">
                <div class="pull-left">
                    <img class="media-object" src="{{ $category->get_thumb(64, 64) }}" alt="{{ $category->title }}">
                </div>
                <div class="media-body">
                    <h4 class="list-group-item-heading">{{ $category->title }}</h4>
                    <p class="list-group-item-text">{{ $category->description }}</p>
                </div>
            </div>
        </a>
        @endforeach
    @endif
  </ul>
</div>