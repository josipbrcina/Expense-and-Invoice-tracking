<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Expense and Invoice tracking</title>

<!-- Styles -->
<link href="/css/app.css" rel="stylesheet">

<!-- Scripts -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script>

    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
    ]); ?>

</script>
</head>