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
    <!-- load app javascript, jquery and jquery UI for datepicker -->
    <script src="/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {
            $( "#datepicker, #datepicker2" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
    </script>
    <!-- load ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

    <!-- Delete button authorization -->
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    <!-- display chart -->
    <script>
        $(function () {
            // create data object

            var data = {
                labels : ["January", "February", "March", "April", ["June","2015"], "July", "August", "September", "October", "November", "December"],
                datasets : [
                    {
                        label: 'Expenses',
                        borderColor: "F5F5DC",
                        fillColor: "rgba(220,220,220,0.4)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        data: [90+100, 20, 110, 81, 56, 55, 44, 124, 55, 65, 133,]


                    },
                    {
                        label: 'Invoices',
                        borderColor: "F5F5DC",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        data: [65, 59, 80, 81, 56, 55, 40, 96, 105, 44, 150]

                    }
                ]
            };

            var option = {
                BezierCurveTension : 0.2,
                pointDotRadius : 4,

            };

            //get the content of canvas element we want to select

            var chart = document.getElementById('chart').getContext('2d');
            var lineChartInstance = new Chart(chart).Line(data, option);

        });

    </script>

</body>
    <footer class="row">
        @include('includes.footer')
    </footer>
</html>
