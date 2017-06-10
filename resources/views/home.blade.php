@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h2>Arenas</h2>
                    <p><a href="{{ action('ArenaController@createForm') }}" class="btn btn-primary">Create new arena</a></p>
                    @foreach (App\Arena::all() as $arena)
                        <div class="arena panel panel-default">
                            <div class="panel-heading">{{ $arena->name }}</div>
                            <div class="panel-body">
                                <p>Players: {{ $arena->users()->count() }}</p>
                                <p><a href="#" class="btn btn-primary">Join</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
