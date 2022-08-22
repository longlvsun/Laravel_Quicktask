@extends('layout')

@section('content')
<div class="container">
    <div id="errs">
        @if (isset($errors) && $errors->any())
            @foreach ($errors->all() as $err)
                <div class="text-danger mb-3">{{ $err }}</div>
            @endforeach
        @endif
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ trans('user.username') }}</th>
                <th scope="col">{{ trans('user.email') }}</th>
                <th scope="col">{{ trans('user.first_name') }}</th>
                <th scope="col">{{ trans('user.last_name') }}</th>
                <th scope="col">{{ trans('user.is_admin') }}</th>
                <th scope="col">{{ trans('user.is_active') }}</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users->items() as $user)
                <tr>
                    <th scope="row">
                        <a href="{{ route('users.show', ['user' => $user->id]) }}">
                            {{ $user->id }}
                        </a>
                    </th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>
                        <input
                            type="checkbox"
                            @if ($user->is_admin)
                                checked
                            @endif
                        />
                    </td>
                    <td>
                        <input
                            type="checkbox"
                            @if ($user->is_active)
                                checked
                            @endif
                        />
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('users.edit', ['user' => $user->id]) }}">
                            {{ trans('user.edit') }}
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                {{ trans('user.destroy') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row mt-5">
        {{ $users->links() }}
    </div>
</div>
@stop
