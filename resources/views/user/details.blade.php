@extends('admin.layout')

@section('content')

    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2>{{ $album->title }}</h2>
                <h5 class="text-muted">
                    {{ $album->artist->name ?? '-' }}
                </h5>
            </div>

            <div>

            <span class="badge badge-primary p-2">
                {{ $album->price }} ₺
            </span>

                @if($album->stock > 0)

                    <span class="badge badge-success p-2">
                    Stock : {{ $album->stock }}
                </span>

                @else

                    <span class="badge badge-danger p-2">
                    Out of Stock
                </span>

                @endif

            </div>

        </div>

        <div class="row">

            <!-- Songs -->

            <div class="col-md-6">

                <div class="card shadow mb-4">

                    <div class="card-header bg-primary text-white">
                        Songs
                    </div>

                    <div class="card-body">

                        @forelse($songs as $song)

                            <p>🎵 {{ $song->name }}</p>

                        @empty

                            <p>No songs found.</p>

                        @endforelse

                    </div>

                </div>

            </div>

            <!-- Reviews -->

            <div class="col-md-6">

                <div class="card shadow mb-4">

                    <div class="card-header bg-success text-white">
                        Reviews
                    </div>

                    <div class="card-body">
                        <form action="{{ route('reviews.store') }}" method="POST" class="mb-4">

                            @csrf

                            <input type="hidden"
                                   name="album_id"
                                   value="{{ $album->id }}">

                            <div class="form-group">

            <textarea
                name="comment"
                class="form-control"
                rows="3"
                placeholder="Write your review..."></textarea>

                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                Add Review
                            </button>

                        </form>

                        <hr>

                        @forelse($reviews as $review)

                            <div class="border-bottom mb-3 pb-2">

                                <strong>
                                    {{ $review->user_name }}
                                </strong>

                                <br>

                                {{ $review->comment }}

                            </div>

                        @empty

                            <p>No reviews yet.</p>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
