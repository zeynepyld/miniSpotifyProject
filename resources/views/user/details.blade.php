@extends('admin.layout')

@section('content')

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

    <div class="container-fluid">

        <div class="row">

            <!-- Album Information -->

            <div class="col-lg-4">

                <div class="card shadow mb-4">

                    <div class="card-body text-center">

                        @if($album->cover_image)
                            <img src="{{ asset($album->cover_image) }}"
                                 class="img-fluid rounded shadow mb-3"
                                 style="max-height:300px;">
                        @else
                            <img src="https://via.placeholder.com/300x300?text=No+Cover"
                                 class="img-fluid rounded shadow mb-3">
                        @endif

                        <h3 class="font-weight-bold">
                            {{ $album->title }}
                        </h3>

                        <h5 class="text-muted">
                            {{ $album->artist->name ?? 'Unknown Artist' }}
                        </h5>

                            @php
                                $average = round($album->reviews->avg('rating'), 1);
                            @endphp

                            <div class="my-3">

                                @if($album->reviews->count())

                                    <div style="font-size:28px;">

                                        @for($i = 1; $i <= 5; $i++)

                                            @if($i <= round($average))
                                                <span style="color:gold;">★</span>
                                            @else
                                                <span style="color:#ddd;">★</span>
                                            @endif

                                        @endfor

                                    </div>

                                    <h5 class="mt-2 mb-1 font-weight-bold">
                                        {{ $average }}/5
                                    </h5>

                                    <small class="text-muted">
                                        {{ $album->reviews->count() }} Reviews
                                    </small>

                                @else

                                    <h6 class="text-muted">
                                        No ratings yet.
                                    </h6>

                                @endif

                            </div>

                        <hr>

                        <h4 class="text-primary font-weight-bold">
                            {{ $album->price }} ₺
                        </h4>

                        @if($album->stock > 0)

                            <span class="badge badge-success p-2">
                            Stock : {{ $album->stock }}
                        </span>

                        @else

                            <span class="badge badge-danger p-2">
                            Out of Stock
                        </span>

                        @endif

                        <div class="mt-3">

                            @if($album->stock > 0)

                                <form action="{{ route('admin.order.place',$album->id) }}" method="POST">
                                    @csrf

                                    <button class="btn btn-success btn-block">
                                        <i class="fas fa-shopping-cart"></i>
                                        Buy Album
                                    </button>

                                </form>

                            @else

                                <button class="btn btn-secondary btn-block" disabled>
                                    Out of Stock
                                </button>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- Songs + Reviews -->

            <div class="col-lg-8">

                <!-- Songs -->

                <div class="card shadow mb-4">

                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0">Songs</h6>
                    </div>

                    <div class="card-body">

                        <ul class="list-group list-group-flush">

                            @forelse($songs as $song)

                                <li class="list-group-item">
                                    🎵 {{ $song->name }}
                                </li>

                            @empty

                                <li class="list-group-item text-muted">
                                    No songs found.
                                </li>

                            @endforelse

                        </ul>

                    </div>

                </div>

                <!-- Reviews -->

                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h6 class="m-0">
                            Reviews
                        </h6>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('reviews.store') }}" method="POST">

                            @csrf

                            <input type="hidden"
                                   name="album_id"
                                   value="{{ $album->id }}">

                            <div class="form-group">

                                <label>Your Rating</label>

                                <select name="rating"
                                        class="form-control"
                                        required>

                                    <option value="">Choose Rating</option>
                                    <option value="5">★★★★★ (5)</option>
                                    <option value="4">★★★★☆ (4)</option>
                                    <option value="3">★★★☆☆ (3)</option>
                                    <option value="2">★★☆☆☆ (2)</option>
                                    <option value="1">★☆☆☆☆ (1)</option>

                                </select>

                            </div>

                            <div class="form-group">

                            <textarea
                                name="comment"
                                rows="4"
                                class="form-control"
                                placeholder="Write your review..."
                                required></textarea>

                            </div>

                            <button class="btn btn-success">
                                Submit Review
                            </button>

                        </form>

                        <hr>

                        @forelse($reviews as $review)

                            <div class="border rounded p-3 mb-3">

                                <h6 class="mb-1">
                                    {{ $review->user_name ?? 'Guest' }}
                                </h6>

                                <div class="mb-2" style="font-size:20px;">

                                    @for($i=1;$i<=5;$i++)

                                        @if($i <= $review->rating)

                                            <span style="color:gold;">★</span>

                                        @else

                                            <span style="color:#ddd;">★</span>

                                        @endif

                                    @endfor

                                </div>

                                <p class="mb-1">
                                    {{ $review->comment }}
                                </p>

                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y H:i') }}
                                </small>

                            </div>

                        @empty

                            <div class="alert alert-light">
                                No reviews yet.
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
