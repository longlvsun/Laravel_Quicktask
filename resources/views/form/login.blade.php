@extends('layout')

@section('content')
    <div class="container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">{{ trans('user.email') }}</label>
                <input
                    name="email"
                    type="email"
                    class="form-control"
                    id="email"
                    aria-describedby="emailHelp"
                    placeholder="{{ trans('form.enter_email') }}"
                    required
                />
                <small id="emailHelp" class="form-text text-muted">
                    {{ trans('form.not_show_mail') }}
                </small>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('user.password') }}</label>
                <input
                    name="password"
                    type="password"
                    class="form-control"
                    id="password"
                    placeholder="{{ trans('form.enter_password') }}"
                    required
                />
            </div>
            <div class="form-group form-check">
                <input
                    name="remember"
                    type="checkbox"
                    class="form-check-input"
                    id="remember"
                />
                <label class="form-check-label" for="remember">
                    {{ trans('form.remember') }}
                </label>
            </div>
            <div id="errs">
                @if (isset($errors) && $errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="text-danger mb-3">{{ $err }}</div>
                    @endforeach
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                {{ trans('form.login') }}
            </button>
            <a class="btn btn-secondary" href="{{ route('signup') }}">
                {{ trans('form.signup') }}
            </a>
        </form>
    </div>
@stop
