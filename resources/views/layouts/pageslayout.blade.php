<!DOCTYPE html>
<html lang="en">
        @include ('includes.head');
<body>
    <div id="app">
        @include ('includes.navbar');
         <div id="sidebar" class="col-md-2">
            @include ('includes.sidebar');
         </div>

        <div class="col-md-8">
            @yield('content')
        </div>

    </div>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Scripts -->
    <script src="/js/app.js"></script>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            //console.log($( "#datepicker" ));
            $( "#datepicker" )[0].datepicker({
            });
        } );
    </script>
</body>
    <footer class="row">
        @include('includes.footer')
    </footer>
</html>
