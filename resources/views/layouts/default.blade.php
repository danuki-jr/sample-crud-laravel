<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="default-container">
            @yield('content')
            @include('includes.overlay')
        </div>
    </body>
</html>
