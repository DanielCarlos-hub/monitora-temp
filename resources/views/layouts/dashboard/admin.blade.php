<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title> @isset($title){{ $title }} @else {{ config('app.name', 'Laravel') }} @endif </title>

        <meta name="author" content="Freezolar Refrigeração">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/storage/site/favicon/favicon-16x16.png">
        <link rel="icon" sizes="192x192" type="image/png" href="/storage/site/favicon/android-chrome-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/storage/site/favicon/apple-touch-icon.png">


        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" href="{{ asset('dashboard/js/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('dashboard/css/oneui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/js/plugins/toastr/build/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/js/plugins/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset("dashboard/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") }}">
        @yield('css_after')

        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed">

            @component('components.dashboard.admin.sidebar')@endcomponent
            @component('components.dashboard.admin.header')@endcomponent

            <main id="main-container">
                @yield('content')
            </main>

        </div>

        <script src="{{ asset('dashboard/js/oneui.app.js') }}"></script>
        <script src="{{ asset('dashboard/js/laravel.app.js') }}"></script>

        <!-- Moment JS Plugin -->
        <script src="{{ asset('dashboard/js/plugins/moment/moment.min.js') }}"></script>
        <!-- Toastr JS Plugin -->
        <script src="{{asset('dashboard/js/plugins/toastr/build/toastr.min.js') }}"></script>
        <!-- DataTable JS Plugin -->
        <script src="{{asset('dashboard/js/plugins/datatables/datatables.min.js') }}"></script>
        <script src="{{asset('https://cdn.datatables.net/plug-ins/1.10.24/sorting/date-euro.js') }}"></script>
        <!-- Select2 JS Plugin -->
        <script src="{{asset('dashboard/js/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Summernote JS Plugin -->
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
        <!-- Inputmask -->
        <script src="{{ asset('dashboard/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard/inputmask/dist/mask.init.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('dashboard/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
        <!-- Datepicker -->
        <script src="{{ asset('dashboard/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('dashboard/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
        <!-- SweetAlert 2-->
        <script src="{{ asset('dashboard/sweetalert2.all.min.js') }}"></script>
        <!-- Custom JS -->
        <script src="{{ asset('dashboard/js/custom.js') }}"></script>

        <script>

            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;

                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;

                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        </script>

       @hasSection('javascript')
            @yield('javascript')
        @endif

    </body>
</html>
