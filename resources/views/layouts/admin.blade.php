<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Chhitomitho') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="{{ asset('assets/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link href="{{ asset('assets/mdb/css/addons/datatables.min.css') }}" rel="stylesheet">
    @stack('styles')
    
</head>
<body>
    <div class="d-flex">
        <div class="side">
            @include('components.admin-sidebar')
        </div>
        <div class="main">
            
            @yield('content')
            
        </div>
    </div>
    
    <script type="text/javascript" src="{{ asset('assets/mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/mdb/js/addons/datatables.min.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @stack('scripts')
    
</body>
</html>
