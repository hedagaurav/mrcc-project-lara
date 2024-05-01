<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MRCC Project') }}</title>
    <!-- Include any CSS files here -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul type='none'>
                <li><a href="{{ route('project.index') }}">Project</a></li>
                <li><a href="{{ route('project.index') }}">Task</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <!-- Include any JavaScript files here -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    {{-- common footer  --}}
    @include('layouts.common_footer')
    @yield('common_footer')
    
    {{-- common footer  --}}

    {{-- file footer --}}
    @yield('footer-js')
    {{-- file footer --}}

</body>
</html>