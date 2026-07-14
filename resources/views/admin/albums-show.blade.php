@extends('layouts.app') {{-- Veya senin kullandığın ana layout adı --}}

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $album->title }}</h1>
                <p><strong>Genre:</strong> {{ $album->genre }}</p>
                <p><strong>Price:</strong> ${{ $album->price }}</p>
                <p><strong>Stock:</strong> {{ $album->stock }}</p>
            </div>

            <div class="col-md-6">
                <h3>Yorum Yap</h3>
                @auth
                    <form action="{{ route('reviews.store', $album->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="comment" class="form-control" rows="3" required placeholder="Albüm hakkındaki düşüncelerini yaz..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Yorumu Gönder</button>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">
                            <div class="card p-3 mb-4">
                                <h4>Yorum Yap</h4>
                            </div>

                            <div class="card p-3">
                                <h4>comments</h4>
                                <hr>
                                @if($reviews->isEmpty())
                                    <p>there is no comments yet</p>
                                @else
                                    @foreach($reviews as $review)
                                        <div class="mb-3 p-3 border rounded">
                                            <strong>{{ $review->user->name ?? 'Kullanıcı' }}:</strong>
                                            <p>{{ $review->comment }}</p>
                                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <p>Yorum yapmak için lütfen <a href="{{ route('login') }}">giriş yapın</a>.</p>
                @endauth
            </div>
        </div>

        <hr>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Yorumlar</h3>
                @foreach($reviews as $review)
                    <div class="card mb-2">
                        <div class="card-body">
                            <strong>{{ $review->user_name }}</strong>: {{ $review->comment }}
                            <small class="text-muted d-block">{{ $review->created_at }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
