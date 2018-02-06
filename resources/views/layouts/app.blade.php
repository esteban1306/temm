<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('app.assets_head')
    <body>
    @include('app.header')
    @yield('content')
    @yield('scripts')
    </body>
</html>
