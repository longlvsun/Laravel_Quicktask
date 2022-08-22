@extends('layout')

@php
$user = auth()->user();
@endphp

@section('content')
    <div class="container mt-3">
        <div class="d-flex">
            <h3 class="flex-grow-1">{{ trans('messages.hi') . ' ' . $user->fullName }}</h3>
            <a class="btn btn-outline-secondary me-3" href="{{ route('users.index') }}">
                {{ trans('user.list') }}
            </a>
            <a class="btn btn-primary" href="{{ route('logout') }}">
                {{ trans('form.logout') }}
            </a>
        </div>
        <span>{{ trans('messages.has_num_notes', ['num' => $user->notes->count()]) }}.</span>
        <div class="d-flex">
            @foreach ($user->notes as $note)
                <div class="card m-3 w-25">
                    <div class="card-header">{{ $note->title }}</div>
                    <div class="card-body">{{ $note->content }}</div>
                </div>
            @endforeach
        </div>
    </div>
@stop
