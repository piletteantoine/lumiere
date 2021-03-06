@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">@lang('app.close')</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div id="google-map" class="map"></div>

<div class="wrapper">  
  <div class="secondary-navigation">
    <div class="filter-zone">
        <p class="headings">Je recherche un(e) 
            <select class="custom-select" id="category-selector">
                <option value="0">film</option>
            @if( ! is_null( $categories ) && ! empty( $categories ) )
                @foreach( $categories as $category )
                <option id="category-selector-{{ $category->id }}" value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            @endif
            </select>
            de type
            <select class="custom-select" id="type-selector">
                <option value="0">Indifférent</option>
                <option value="short">Court-métrage</option>
                <option value="long">Long-métrage</option>
            </select>
        </p>
    </div>
   </div>
</div>

<div class="dragdealer">
    <div>
        <input type="checkbox" name="single-slider" id="single-slider" checked="checked" />
        <label>Sélection simple</label>
    </div>
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

<div class="modal fade right-modal" id="slideRight">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addCard">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        @include('public.cards.create')
      </div>
    </div>
  </div>
</div>