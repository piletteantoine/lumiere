@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div class="col-md-8">
    <div id="google-map" style="width: 800px; height: 550px"></div>
</div>
<div class="col-md-4">
    <ul>
      @if( ! is_null( $categories ) && ! empty( $categories ) )
        @foreach( $categories as $category )
        <li><a href="#" class="category-selector" data-id="{{ $category->id }}">{{ $category->title }}</a></li>
        @endforeach
        <li><a href="#" class="category-selector" data-id="0">Toutes</a></li>
      @endif
    </ul>

    <div id="slider"></div>
    <div id="sentence"></div>
</div>
<div class="modal fade" id="ajax">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="slideRight">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        @include('public.cards.create')
    </form>
      </div>
    </div>
  </div>
</div>