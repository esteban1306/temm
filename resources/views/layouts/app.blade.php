<!doctype html>
<html lang="{{ app()->getLocale() }}">
    @include('app.assets_head')
    <body>
    @include('app.header')
    @yield('content')
    @include('app/footer')
    </body>
    @yield('scripts')
</html>
