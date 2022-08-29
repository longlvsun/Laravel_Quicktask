@extends('layout')

@section('content')
<div class="container">
    <div class="card m-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <input form="editForm" class="form-control me-2" name="title" value="{{ $note->title }}" />
                <div class="d-flex justify-content-end">
                    <button class="btn btn-warning me-1" type="submit" form="editForm">
                        {{ trans('messages.edit') }}
                    </button>
                    <form action="{{ route('notes.destroy', ['note' => $note->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">{{ trans('messages.destroy') }}</button>
                    </form>
                </div>
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
            <form action="{{ route('notes.update', ['note' => $note->id]) }}" id="editForm" method="POST">
                @method('PUT')
                @csrf
                <textarea class="form-control min-h-70" name="content">{{ $note->content }}</textarea>
            </form>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                <div>
                    <span>{{ trans('messages.created_at') }}:</span>
                    {{ $note->created_at }}
                </div>
                <div>
                    <span>{{ trans('messages.updated_at') }}:</span>
                    {{ $note->updated_at }}
                </div>
            </div>
            <div>
                <a href="{{ route('home') }}" class="btn btn-primary me-1">
                    {{ trans('messages.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@stop
