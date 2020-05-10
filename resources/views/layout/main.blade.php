<!DOCTYPE html>
<html lang="en">

@include('layout.head')
@yield('styles')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed ">
    <div class="wrapper">
	    @include('layout.navbar')
		      @include('layout.sidebar')
		      <div class="content-wrapper">
		        	@yield('contenido')
		      </div>
	      @include('layout.footer')
    </div>
    @include('layout.scripts')
    @yield('script')
</body>
</html>

