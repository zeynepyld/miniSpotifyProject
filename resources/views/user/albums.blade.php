@extends('admin.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Albums</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Album List
            </h6>
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('user.albums') }}" class="mb-4">

                <label>
                    Filter By Artist
                </label>

                <select
                    name="artist_id"
                    class="form-control"
                    onchange="this.form.submit()">

                    <option value="">
                        All Artists
                    </option>


                    @foreach($artists as $artist)

                        <option
                            value="{{ $artist->id }}"
                            {{ request('artist_id') == $artist->id ? 'selected' : '' }}
                        >

                            {{ $artist->name }}

                        </option>

                    @endforeach


                </select>

            </form>

            <form method="GET" action="{{ route('user.albums') }}" class="mb-3">


            <div class="table-responsive">

                <table class="table table-bordered" width="100%" cellspacing="0">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Album Title</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($albums as $album)

                        <tr>

                            <td>{{ $album->id }}</td>

                            <td>
                                @if($album->cover_image)
                                    <img src="{{ asset($album->cover_image) }}"
                                         width="70"
                                         height="70"
                                         class="img-thumbnail">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $album->title }}</strong>
                            </td>

                            <td>
                                {{ $album->artist->name ?? 'Unknown Artist' }}
                            </td>

                            <td>
                                {{ $album->genre ?? 'N/A' }}
                            </td>

                            <td>
                                <strong>{{ $album->price }} ₺</strong>
                            </td>
                            <td>

                                @php
                                    $average = round($album->reviews->avg('rating'),1);
                                @endphp

                                @if($album->reviews->count())

                                    <div style="font-size:18px;">

                                        @for($i=1;$i<=5;$i++)

                                            @if($i <= round($average))
                                                <span style="color:gold;">★</span>
                                            @else
                                                <span style="color:#ddd;">★</span>
                                            @endif

                                        @endfor

                                    </div>

                                    <small class="font-weight-bold">
                                        {{ $average }}/5
                                    </small>

                                @else

                                    <small class="text-muted">
                                        No Rating
                                    </small>

                                @endif

                            </td>

                            <td>
                                @if($album->stock > 0)
                                    <span class="badge badge-success">
                                        {{ $album->stock }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Out of Stock
                                    </span>
                                @endif
                            </td>

                            <td>

                                @if($album->stock > 0)

                                    <form action="{{ route('admin.order.place', $album->id) }}"
                                          method="POST"
                                          style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-shopping-cart"></i> Buy
                                        </button>
                                    </form>

                                @else

                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-ban"></i> Out of Stock
                                    </button>

                                @endif

                                <a href="{{ route('user.albums.details', $album->id) }}"
                                   class="btn btn-primary btn-sm">
                                    Details
                                </a>

                                <form action="{{ route('user.favorites.store', $album->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                No albums found.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
