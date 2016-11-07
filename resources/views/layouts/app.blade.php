<!DOCTYPE html>
<html lang="en">
        @include ('includes.head');
<body>
    <div id="app">
        @include ('includes.navbar');
        <div class="col-md-8">
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
    <footer class="row">
        @include('includes.footer')
    </footer>
</html>
