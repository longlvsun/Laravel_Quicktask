@extends('layout')

@section('content')
<div class="container">
    <div class="card m-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <input
                    form="createForm"
                    class="form-control me-2"
                    name="title"
                    placeholder="{{ trans('messages.title') }}"
                    required
                />
                <button class="btn btn-primary" form="createForm" type="submit">
                    {{ trans('messages.create') }}
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id="errs">
                @if (isset($errors) && $errors->any())
                    @foreach ($errors->all() as $err)
                        <div class="text-danger mb-3">{{ $err }}</div>
                    @endforeach
                @endif
            </div>
            <form action="{{ route('notes.store') }}" id="createForm" method="POST">
                @csrf
                <textarea
                    class="form-control min-h-70"
                    name="content"
                    placeholder="{{ trans('messages.write_something') }}"
                ></textarea>
            </form>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
            </div>
            <div>
                <a href="{{ route('users.index') }}" class="btn btn-primary me-1">
                    {{ trans('messages.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@stop
