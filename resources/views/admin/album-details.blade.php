@extends('admin.layout')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">{{ $album->title }} Detayları</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.order.place', $album->id) }}" method="POST">
                @csrf

                @if($album->stock > 0)

                    <button type="submit" class="btn btn-success mr-2">
                        Buy
                    </button>

                @else

                    <button type="button" class="btn btn-secondary mr-2" disabled>
                        Out of Stock
                    </button>

                @endif

                <span class="mr-3 font-weight-bold">
        {{ $album->price }} ₺
    </span>

                @if($album->stock > 0)
                    <span class="badge badge-success">
            Stock: {{ $album->stock }}
        </span>
                @else
                    <span class="badge badge-danger">
            Out of Stock
        </span>
                @endif

            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header"><h6>Songs</h6></div>
                    <div class="card-body">
                        <form action="{{ route('admin.songs.store', $album->id) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" placeholder="New song name..." required>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                        <ul>
                            @foreach($songs as $song)
                                <li>{{ $song->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header"><h6>Comments</h6></div>
                    <div class="card-body">
                        <form action="{{ route('admin.reviews.store', $album->id) }}" method="POST" class="mb-4">
                            @csrf
                            <textarea name="comment" class="form-control" placeholder="Write comment..." required></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Send</button>
                        </form>

                        <hr>

                        @forelse($reviews as $review)
                            <div class="mb-2 p-2 border-bottom">
                                <strong>{{ $review->user_name ?? 'Guest' }}:</strong> {{ $review->comment }}
                                <small class="text-muted d-block">{{ $review->created_at }}</small>
                            </div>
                        @empty
                            <p class="text-muted">There is no comment yet. Write the first comment!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
