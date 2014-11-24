<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.title') — {{ isset( $title ) ? $title : Lang::get('menu.home') }}</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet"> -->
    <link href="/assets/css/bootstrap-flatly.css" rel="stylesheet">
    @if( ! is_null( $styles ) && ! empty( $styles ) )
    @foreach( $styles as $style )
    <link href="{{ $style }}" rel="stylesheet">
    @endforeach
    @endif
    <link href="/assets/css/style.css?t={{ time() }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container-fluid">
    {{ $content }}
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    @if( ! is_null( $inline_js ) && ! empty( $inline_js ) )
    <script type="text/javascript">{{ $inline_js }}</script>
    @endif
    <script src="/assets/js/main.js"></script>
    @if( ! is_null( $scripts ) && ! empty( $scripts ) )
    @foreach( $scripts as $script )
    <script src="{{ $script }}"></script>
    @endforeach
    @endif
  </body>
</html>