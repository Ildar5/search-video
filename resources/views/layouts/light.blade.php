<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.partials.head')

<body class="bg-white">
	<main>
		@yield('content')
	</main>
	@include('layouts.partials.footer')
</body>
</html>
