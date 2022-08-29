@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $user->fullName }}</h3>
            <table class="table">
                <tbody>
                    <tr>
                        <th role="row" with="10%">{{ trans('user.email') }}</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th role="row" with="10%">{{ trans('user.username') }}</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th role="row" with="10%">{{ trans('user.is_active') }}</th>
                        <td>{{ $user->is_active ? trans('user.actived') : trans('user.not_active') }}</td>
                    </tr>
                    <tr>
                        <th role="row" with="10%">{{ trans('messages.created_at') }}</th>
                        <td>{{ format_date($user->created_at) }}</td>
                    </tr>
                    <tr>
                        <th role="row" with="10%">{{ trans('messages.updated_at') }}</th>
                        <td>{{ format_date($user->updated_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="errs" class="px-5">
            @if (isset($errors) && $errors->any())
                @foreach ($errors->all() as $err)
                    <div class="text-danger mb-3">{{ $err }}</div>
                @endforeach
            @endif
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary me-3" href="{{ route('users.index') }}">
                    {{ trans('messages.back') }}
                </a>
                <a class="btn btn-warning me-3" href="{{ route('users.edit', ['user' => $user->id]) }}">
                    {{ trans('messages.edit') }}
                </a>
                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button
                        type="button"
                        class="btn btn-danger"
                        onclick="confirmAlert('deleteButton', '{{ trans('form.confirm_destroy', ['username' => $user->username]) }}')"
                    >
                        {{ trans('messages.destroy') }}
                    </button>
                    <button type="submit" id="deleteButton" class="d-none" />
                </form>
            </div>
        </div>
    </div>
</div>
@stop
