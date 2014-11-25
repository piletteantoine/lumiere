<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('app.admin.title') — {{ isset( $title ) ? $title : '' }}</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet"> -->
    @if( ! is_null( $styles ) && ! empty( $styles ) )
    @foreach( $styles as $style )
    <link href="{{ $style }}" rel="stylesheet">
    @endforeach
    @endif
    <link href="/assets/css/style.css?t={{ time() }}" rel="stylesheet">
    <link href="/assets/css/admin.css?t={{ time() }}" rel="stylesheet">

    <script src="https://maps.googleapis.com/maps/api/js?libraries=visualization"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/main.js"></script>
    @if( ! is_null( $scripts ) && ! empty( $scripts ) )
    @foreach( $scripts as $script )
    <script src="{{ $script }}"></script>
    @endforeach
    @endif

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @include('admin.parts.menu')
    <div class="clearfix"></div>
    <div class="wrapper" style="margin-top: 60px">
        <div class="container-fluid">
        {{ $content }}
        </div>
    </div>
  </body>
</html>