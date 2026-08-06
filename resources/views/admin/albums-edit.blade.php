@extends('admin.layout')

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Album
            </h6>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.albums.update', $album->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Album Title</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ $album->title }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Artist</label>

                    <select name="artist_id"
                            class="form-control"
                            required>

                        @foreach($artists as $artist)

                            <option value="{{ $artist->id }}"
                                {{ $album->artist_id == $artist->id ? 'selected' : '' }}>

                                {{ $artist->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">
                    <label>Genre</label>

                    <input type="text"
                           name="genre"
                           class="form-control"
                           value="{{ $album->genre }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Price</label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           class="form-control"
                           value="{{ $album->price }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Stock</label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ $album->stock }}"
                           required>
                </div>

                <div class="form-group">

                    <label>Current Cover</label>

                    <br>

                    @if($album->cover_image)

                        <img src="{{ asset($album->cover_image) }}"
                             width="150"
                             class="img-thumbnail mb-3">

                    @else

                        <p class="text-muted">
                            No cover uploaded yet.
                        </p>

                    @endif

                </div>

                <div class="form-group">

                    <label>Change Cover</label>

                    <input type="file"
                           name="cover_image"
                           class="form-control"
                           accept="image/*">

                </div>

                <button type="submit"
                        class="btn btn-warning">
                    Update Album
                </button>

            </form>

        </div>

    </div>
@endsection
