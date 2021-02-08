@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <h1> Details for {{$cargo}}

        {{-- @foreach ($details as $cargo)
            {{ $cargo->name }}
        @endforeach --}}
        </h1>
    </div>
</div>
@endsection
