@php
$curr_lang = config('app.locale');
$langs = config('lang.langs');
@endphp

<div class="container">
    <div class="d-flex justify-content-end">
        @foreach($langs as $locale => $lang)
            <a
                class="btn {{ $locale == $curr_lang ? 'btn-primary' : 'btn-secondary'  }} m-2"
                href="{{ route('changeLanguage', ['lang' => $locale]) }}"
            >
                {{ $lang }}
            </a>
        @endforeach
    </div>
</div>
