@extends('layout')

@section('content')
<div class="container">
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="email">{{ trans('user.email') }}</label>
            <input
                name="email"
                type="email"
                class="form-control"
                id="email"
                value="{{ $user->email }}"
                aria-describedby="emailHelp"
                placeholder="{{ trans('form.enter_email') }}"
            />
        </div>
        <div class="form-group">
            <label for="username">{{ trans('user.username') }}</label>
            <input
                name="username"
                type="text"
                class="form-control"
                id="username"
                value="{{ $user->username }}"
                placeholder="{{ trans('user.username') }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="firstName">{{ trans('user.first_name') }}</label>
            <input
                name="first_name"
                type="text"
                class="form-control"
                id="firstName"
                value="{{ $user->first_name }}"
                placeholder="{{ trans('user.first_name') }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="lastName">{{ trans('user.last_name') }}</label>
            <input
                name="last_name"
                type="text"
                class="form-control"
                id="lastName"
                value="{{ $user->last_name }}"
                placeholder="{{ trans('user.last_name') }}"
                required
            />
        </div>
        <div class="form-group">
            <label for="password">{{ trans('user.password') }}</label>
            <input
                name="password"
                type="password"
                class="form-control"
                id="password"
                placeholder="{{ trans('form.enter_password') }}"
            />
        </div>
        <div class="form-group">
            <label for="oldPassword">{{ trans('user.old_password') }}</label>
            <input
                name="old_password"
                type="password"
                class="form-control"
                id="oldPassword"
                placeholder="{{ trans('form.enter_old_password') }}"
                required
            />
        </div>
        <div id="errs">
            @if (isset($errors) && $errors->any())
                @foreach ($errors->all() as $err)
                    <div class="text-danger mb-3">{{ $err }}</div>
                @endforeach
            @endif
        </div>
        <div class="mt-3">
            <a class="btn btn-primary" href="{{ url()->previous() }}">
                {{ trans('messages.cancel') }}
            </a>
            <button type="submit" class="btn btn-warning">
                {{ trans('messages.edit') }}
            </button>
            <button form="deleteForm" type="submit" class="btn btn-danger">
                {{ trans('messages.destroy') }}
            </button>
        </div>
    </form>
    <form id="deleteForm" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
        @method('DELETE')
        @csrf
    </form>
</div>
@stop
