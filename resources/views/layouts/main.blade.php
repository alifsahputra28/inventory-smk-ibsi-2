<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laboratory Inventory System SMK Ibnu Sina</title>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @vite(['resources/sass/app.scss'])
        <!-- Favicon -->
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('assets/img/logo-smk-ibnu-sina.png') }}"
        />
        <!-- Volt CSS -->
        <link
            type="text/css"
            href="{{ asset('assets/css/volt.css') }}"
            rel="stylesheet"
        />
        <!-- Script Ajax -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{-- icon bootstrap --}}
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        />

        <!-- Remix Icon -->
        <link
            href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css"
            rel="stylesheet"
        />

         {{-- DATE PICKER --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">

          {{-- DATE PICKER --}}
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
          <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
    </head>

    <body>
        @include('layouts.sidebar')
        <main class="content">
            @include('sweetalert::alert')
            @include('layouts.navbar')
            @yield('content')
            @include('layouts.footer')
        </main>

        <!-- Core -->
        <script src="{{
                asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js')
            }}"></script>
        <script src="{{
                asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js')
            }}"></script>

        <!-- Vendor JS -->
        <script src="{{
                asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')
            }}"></script>

        <!-- Smooth scroll -->
        <script src="{{
                asset(
                    'assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js'
                )
            }}"></script>

        {{-- JS --}}
        <script src="{{ asset('/assets/js/myCustom.js') }}"></script>
        >
        <!-- Volt JS -->
        <script src="{{ asset('assets/js/volt.js') }}"></script>

        <!-- Sweetalert -->
        <script src="{{
                asset('vendor/sweetalert/sweetalert.all.js')
            }}"></script>

        {{-- Datatables --}}
        {{--
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        --}}
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"
        />

        <script
            type="text/javascript"
            charset="utf8"
            src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"
        ></script>

        
      {{-- START CDN BUTTON EXPORT --}}
      <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    {{-- START CDN BUTTON EXPORT --}}
    </body>
</html>
