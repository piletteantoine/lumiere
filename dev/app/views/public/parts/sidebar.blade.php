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
De : <input type="number" id="yearfrom" /><br>
À : <input type="number" id="yearto" /><br>

<h3>Apply</h3>
<button id="apply">Appliquer</button>

<h3>Results</h3>
<div id="sentence"></div>