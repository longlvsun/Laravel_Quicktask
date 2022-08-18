@extends('layout')

@php
$user = auth()->user();
@endphp

@section('content')
    <div class="container mt-3">
        <div class="d-flex">
            <h3 class="flex-grow-1">Hi {{ $user->fullName }}</h3>
            <a class="btn btn-primary" href="/logout">Logout</a>
        </div>
        <span>You have {{ $user->notes->count() }} notes.</span>

        <div class="d-flex">
        @foreach($user->notes as $note)
            <div class="card m-3 w-25">
                <div class="card-header">{{ $note->title }}</div>
                <div class="card-body">{{ $note->content }}</div>
            </div>
        @endforeach
        </div>
    </div>
@stop
