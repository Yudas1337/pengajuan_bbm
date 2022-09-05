<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    @include('dashboard.layouts.header')
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('home') }}">
                    <span class="align-middle me-3">Dashboard</span>
                </a>

                <ul class="sidebar-nav">
                    @include('dashboard.layouts.sidebar')
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>


                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        @include('dashboard.layouts.navbar')
                    </ul>
                </div>
            </nav>

            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                @include('dashboard.layouts.footer')
            </footer>
        </div>
    </div>

    <script src="{{ asset('app-assets/js/app.js') }}"></script>

    @yield('footer')
</body>

</html>
