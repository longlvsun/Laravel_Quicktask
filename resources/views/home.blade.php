@extends('layout')

@php
$user = auth()->user();
@endphp

@section('content')
    <div class="container mt-3">
        <span>{{ trans('messages.has_num_notes', ['num' => $user->notes->count()]) }}.</span>
        <span><a href="{{ route('notes.create') }}">{{ trans('messages.create_new') }}</a></span>
        <div class="d-flex">
            @foreach ($user->notes as $note)
                <div class="card m-3 w-25">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('notes.edit', ['note' => $note->id]) }}">
                                {{ $note->title }}
                            </a>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-warning me-1" href="{{ route('notes.edit', ['note' => $note->id]) }}">{{ trans('messages.edit') }}</a>
                                <form action="{{ route('notes.destroy', ['note' => $note->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">{{ trans('messages.destroy') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ strlen($note->content) > 100
                            ? substr($note->content, 100) . '...'
                            : $note->content
                        }}
                    </div>
                    <div class="card-footer">
                        <div>
                            <span>{{ trans('messages.created_at') }}:</span>
                            {{ format_date($note->created_at) }}
                        </div>
                        <div>
                            <span>{{ trans('messages.updated_at') }}:</span>
                            {{ format_date($note->updated_at) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
