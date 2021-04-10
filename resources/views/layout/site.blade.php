
@include('layout._includes.topo')
@if (!Auth::guest())
    @include('layout._includes.menu')
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
    @include('layout._includes.navtop')
@endif

@yield('conteudo')

@if (!Auth::guest())
</div>
</div>
@endif

@include('layout._includes.footer')

