@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create new arena</h1>
        <form action="{{ action('ArenaController@create') }}" method="post">
            {{ csrf_field() }}
            <p>
                <label for="name">Arena name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </p>
            <p class="checkbox">
                <input type="hidden" name="private" value="0">
                <label><input type="checkbox" class="" id="private" name="private" value="1" {{ old('private') === 1 ? 'checked' : '' }}>Private</label>
            </p>
            <p>
                <button class="btn btn-primary" type="submit">Create</button>
            </p>
        </form>
    </div>
@stop
