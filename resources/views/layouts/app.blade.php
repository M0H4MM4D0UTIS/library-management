<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('css')
    <link rel="stylesheet" href="/css/font.css">
    <style>body{font-family: IRANSans !important;}</style>
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('js')
</head>
<body class="bg-gray-200 min-h-screen font-base" dir="rtl">
<div id="app">

    <div class="flex flex-col md:flex-row">

        <base-sidebar></base-sidebar>

        <div class="w-full md:flex-1">
            <nav class="hidden md:flex justify-between items-center bg-white p-4 shadow-md h-16">
                <div>
                    <!--<input class="px-4 py-2 bg-gray-200 border border-gray-300 rounded focus:outline-none" type="text"
                           placeholder="جستجو.."/>-->
                </div>
                <div>
                <a href="{{route('home.notifications')}}" class="mx-2 text-gray-700 focus:outline-none">
                <svg style="display: unset;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    اطلاعیه ها</a>
                    <a href="{{route('home.profile')}}" class="mx-2 text-gray-700 focus:outline-none"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: unset;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        پروفایل</a>
                    <button class="mx-2 text-gray-700 focus:outline-none"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg class="h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             viewBox="0 0 24 24" stroke="currentColor" style="display: unset;">
                            <path
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        خروج
                    </button>

                </div>
            </nav>
            <main>
                <!-- Replace with your content -->
                <div class="px-8 py-6">
                    @include('flash-message')
                    @yield('content')
                </div>
                <!-- /End replace -->
            </main>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>


</div>
@section('data_side_name')
    @switch(Route::current()->getName())
        @case('home.users')
        @case('home.edituserprofile')
        @case('home.addnewuser')
        users
        @break

        @case('home.categories')
        @case('home.addoreditcategory')
        categories
        @break

        @case('home.members')
        @case('home.addoreditmember')
        members
        @break

        @case('home.books')
        @case('home.addoreditbook')
        books
        @break

        @case('home.ammanatketabjadid')
        ammanatketabjadid
        @break

        @case('home.ammanatdade')
        ammanatdade
        @break

        @default
        home
    @endswitch
@endsection
<script type="application/javascript">
    $(document).ready(function() {
        jQuery('li[data-side-name="{{trim(View::yieldContent('data_side_name'))}}"]')
            .removeClass('hover:bg-gray-900').addClass('bg-gray-900');
    });
</script>

</body>
</html>
