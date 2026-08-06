@extends('admin.layout')

@section('content')

    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">
            Welcome {{ auth()->user()->name }} 🎵
        </h1>

        <div class="alert alert-primary">
            Welcome to <strong>MusicStore</strong>.
            Browse albums, purchase music, leave reviews and manage your favorites.
        </div>

        <hr>

        <h3 class="mb-4">
            🏆 Top Rated Albums
        </h3>

        <div class="row">

            @forelse($topAlbums as $album)

                @php
                    $average = round($album->reviews->avg('rating'),1);
                @endphp

                <div class="col-lg-4">

                    <div class="card shadow mb-4">

                        @if($album->cover_image)

                            <img src="{{ asset($album->cover_image) }}"
                                 style="height:280px;object-fit:cover;">

                        @endif

                        <div class="card-body text-center">

                            <h4>{{ $album->title }}</h4>

                            <p class="text-muted">
                                {{ $album->artist->name }}
                            </p>

                            <h5 class="text-success">
                                {{ $album->price }} ₺
                            </h5>

                            <div style="font-size:22px">

                                @for($i=1;$i<=5;$i++)

                                    @if($i<=round($average))

                                        <span style="color:gold;">★</span>

                                    @else

                                        <span style="color:#ddd;">★</span>

                                    @endif

                                @endfor

                            </div>

                            <strong>

                                {{ $average }}/5

                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $album->reviews->count() }} Reviews

                            </small>

                            <br><br>

                            <a href="{{ route('user.albums.details',$album->id) }}"
                               class="btn btn-primary btn-block">

                                View Album

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-warning">

                        No rated albums yet.

                    </div>

                </div>

            @endforelse

        </div>

    </div>

@endsection
