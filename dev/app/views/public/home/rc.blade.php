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
    <h3>Categories :</h3>
    <ul>
      @if( ! is_null( $categories ) && ! empty( $categories ) )
        @foreach( $categories as $category )
        <li><a href="#" class="category-selector" data-id="{{ $category->id }}">{{ $category->title }}</a></li>
        @endforeach
        <li><a href="#" class="category-selector" data-id="0">Toutes</a></li>
      @endif
    </ul>

    <h3>Années :</h3>
    De : <input type="number" id="yearfrom" value="2010" /><br>
    À : <input type="number" id="yearto" value="2015" /><br>

    <h3>Apply</h3>
    <button id="apply">Appliquer</button>

    <h3>Results</h3>
    <div id="sentence"></div>
</div>
<div class="modal fade" id="add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Ajouter une fiche</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>