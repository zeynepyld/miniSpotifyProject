@extends('admin.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Album</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Album Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Artist</label>
                    <select name="artist_id" class="form-control" required>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre" class="form-control" required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->name }}">
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Album Cover</label>

                    <input
                        type="file"
                        name="cover_image"
                        class="form-control"
                        accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Save Album</button>
            </form>
        </div>
    </div>
@endsection
