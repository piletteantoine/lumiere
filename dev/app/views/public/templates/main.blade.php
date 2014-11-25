<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.title') {{ isset( $title ) ? '— ' . $title : '' }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/bootstrap-theme.min.css') }}" rel="stylesheet"> -->
    @if( ! is_null( $styles ) && ! empty( $styles ) )
    @foreach( $styles as $style )
    <link href="{{ $style }}" rel="stylesheet">
    @endforeach
    @endif
    <link href="{{ asset('assets/css/style.css?t=' . time() ) }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link href="{{ asset('assets/css/hotfixes.css?t=' . time() ) }}" rel="stylesheet">

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=visualization"></script>
    <script src="{{ asset('assets/js/markerclusterer.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
  </head>
  <body>
    @include('public.parts.menu')
    <div id="content">
        <h1 class="page-header">{{ $content_title }}</h1>
        {{ $content }}
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
        </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>