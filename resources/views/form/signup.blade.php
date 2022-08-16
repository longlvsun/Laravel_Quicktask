@extends('layout')

@section('content')
    <div class="container">
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">{{ trans('form.email') }}</label>
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
                <label for="username">{{ trans('form.username') }}</label>
                <input
                    name="username"
                    type="text"
                    class="form-control"
                    id="username"
                    placeholder="{{ trans('form.username') }}"
                    required
                />
            </div>
            <div class="form-group">
                <label for="firstName">{{ trans('form.first_name') }}</label>
                <input
                    name="first_name"
                    type="text"
                    class="form-control"
                    id="firstName"
                    placeholder="{{ trans('form.first_name') }}"
                    required
                />
            </div>
            <div class="form-group">
                <label for="lastName">{{ trans('form.last_name') }}</label>
                <input
                    name="last_name"
                    type="text"
                    class="form-control"
                    id="lastName"
                    placeholder="{{ trans('form.last_name') }}"
                    required
                />
            </div>
            <div class="form-group">
                <label for="password">{{ trans('form.password') }}</label>
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
                    @foreach($errors->all() as $err)
                        <div class="text-danger mb-3">{{ $err }}</div>
                    @endforeach
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                {{ trans('form.signup') }}
            </button>
            <a class="btn btn-secondary" href="{{ route('login') }}">
                {{ trans('form.login') }}
            </a>
        </form>
    </div>
@stop
