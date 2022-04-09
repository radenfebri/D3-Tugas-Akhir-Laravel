
<!DOCTYPE html>
<html lang="en">

    @include('layouts.head')


<body>
	<div class="wrapper">


    @include('layouts.header')

		<!-- Sidebar -->
            @include('layouts.siderbar')
		<!-- End Sidebar -->

        @yield('content')

		<!-- Custom template | don't include it in your project! -->
        @include('layouts.main')
		<!-- End Custom template -->
	</div>


    @include('layouts.js')

    @include('sweetalert::alert')


</body>
</html>
