<h2 class="page-title">{{ $page->title }}</h2>
@if( Session::has( 'message' ) )
<div class="alert alert-{{ $errors->has() ? 'danger' : 'success' }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
    {{ Session::get('message') }}
</div>
@endif

<div class="well well-lg">{{ $page->excerpt }}</div>
<hr>
<div id="content-page">
	{{ nl2br($page->content) }}
</div>