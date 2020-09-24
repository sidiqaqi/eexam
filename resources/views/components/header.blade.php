@if (Route::has('login'))
    <div class="fixed top-0 left-0 px-6 py-4 sm:block">
        <a href="{{ url('/') }}">{{ config('app.name') }}</a>
    </div>
    <div class="fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">@lang('Login')</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">@lang('Register')</a>
            @endif
        @endif
    </div>
@endif
