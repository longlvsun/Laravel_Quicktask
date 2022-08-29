@php
$user = auth()->user();
$curr_lang = config('app.locale');
$langs = config('lang.langs');
@endphp

<div class="container">
    <div class="d-flex justify-content-end">
        @foreach ($langs as $locale => $lang)
            <a
                class="btn {{ $locale == $curr_lang ? 'btn-primary' : 'btn-secondary'  }} m-2"
                href="{{ route('changeLanguage', ['lang' => $locale]) }}"
            >
                {{ $lang }}
            </a>
        @endforeach
    </div>
    <div class="d-flex align-items-center">
        <a class="btn btn-primary me-3" href="{{ route('home') }}">
            {{ trans('messages.home') }}
        </a>
        @if ($user)
            <h3 class="flex-grow-1">{{ trans('messages.hi') . ' ' . $user->fullName }}</h3>
            @if ($user->is_admin)
                <a class="btn btn-outline-secondary me-3" href="{{ route('users.index') }}">
                    {{ trans('user.list') }}
                </a>
            @endif
            <a class="btn btn-primary" href="{{ route('logout') }}">
                {{ trans('form.logout') }}
            </a>
        @endif
    </div>
</div>
