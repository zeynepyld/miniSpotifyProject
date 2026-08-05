@extends('admin.layout')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Favorites</h1>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3 bg-danger text-white">
                <h6 class="m-0 font-weight-bold">Favorite Albums</h6>
            </div>

            <div class="card-body">

                @if($favorites->count())

                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th>Album</th>
                            <th>Artist</th>
                            <th>Genre</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($favorites as $favorite)

                            <tr>

                                <td>{{ $favorite->album->title }}</td>

                                <td>{{ optional($favorite->album->artist)->name ?? '-' }}</td>

                                <td>{{ $favorite->album->genre }}</td>

                                <td>{{ $favorite->album->price }} ₺</td>

                                <td>

                                    <form action="{{ route('user.favorites.destroy',$favorite->album_id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Remove
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="alert alert-info">
                        You don't have any favorite albums yet.
                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection
