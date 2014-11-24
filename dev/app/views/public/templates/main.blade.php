<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.title') — {{ isset( $title ) ? $title : Lang::get('menu.home') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('assets/css/bootstrap-theme.min.css') }}" rel="stylesheet"> -->
    @if( ! is_null( $styles ) && ! empty( $styles ) )
    @foreach( $styles as $style )
    <link href="{{ $style }}" rel="stylesheet">
    @endforeach
    @endif
    <link href="{{ asset('assets/css/style.css?t=' . time() ) }}" rel="stylesheet">

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src='http://maps.googleapis.com/maps/api/js?sensor=false&#038;ver=4.0'></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @if( ! is_null( $inline_js ) && ! empty( $inline_js ) )
    <script type="text/javascript">{{ $inline_js }}</script>
    @endif
    @if( ! is_null( $scripts ) && ! empty( $scripts ) )
    @foreach( $scripts as $script )
    <script src="{{ $script }}"></script>
    @endforeach
    @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @include('public.parts.menu')
    <div id="content">
        <h1 class="page-header">{{ $content_title }}</h1>
        {{ $content }}
    </div>
  </body>
</html>