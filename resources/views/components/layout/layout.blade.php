<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css')}}">
    <style>
        /* More specific selectors so our link color wins over other rules.
           Targets common containers where links appear (cards, main container).
           Hover uses !important to guarantee the darker shade. */
        .card a.text-secondary,
        .container-fluid a.text-secondary,
        a.text-secondary {
            color: #495057 !important; /* visible, slightly muted */
            transition: color .15s ease-in-out, opacity .15s ease-in-out;
            text-decoration: none;
        }

        .card a.text-secondary:hover,
        .container-fluid a.text-secondary:hover,
        a.text-secondary:hover,
        .card a.text-secondary:focus,
        .container-fluid a.text-secondary:focus,
        a.text-secondary:focus {
            color: #16191b !important; /* darker on hover/focus */
            opacity: 1 !important;
            text-decoration: none;
        }
    </style>
    <title>{{env('APP_NAME')}} @isset($pageTitle) - {{$pageTitle}} @endisset</title>
</head>
<body>
    
    <x-layout.top-bar />

    <div class="container-fluid pt-2">
        <div class="d-flex flex-column flex-md-row">
            <main class="flex-grow-1 p-3">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="{{asset('assets/datatables/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>