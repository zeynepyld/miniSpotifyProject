@extends('admin.layout')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Artist</h1>
    <form action="{{ route('admin.artists.update', $artist->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Artist Name</label>
            <input type="text" name="name" class="form-control" value="{{ $artist->name }}" required>
        </div>
        <div class="form-group">
            <label>Biography</label>
            <textarea name="bio" class="form-control">{{ $artist->bio }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Artist</button>
    </form>
@endsection
