<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title  -->
    <title>{{ config('app.name') }} | {{ $title }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/logo-light.png') }}" type="image/x-icon">
    <!-- StyleSheets  -->
    <link rel="stylesheet" href=" {{ asset('/assets/css/dashlite.css') }}">
    @stack('css')
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            {{-- Sidebar --}}
            @include('dashboard.partials.sidebar')
            <div class="nk-wrap ">
                {{-- Header --}}
                @include('dashboard.partials.header')
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                {{-- Main content --}}
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Footer --}}
                @include('dashboard.partials.footer')
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        $(document).ready(function() {
            const datatableWrap = $(".datatable-wrap");
            const wrappingDiv = $("<div>").addClass("w-100").css("overflow-x", "scroll");
            datatableWrap.children().appendTo(wrappingDiv);
            datatableWrap.append(wrappingDiv);
        });
    </script>
    @stack('js')
</body>

</html>
