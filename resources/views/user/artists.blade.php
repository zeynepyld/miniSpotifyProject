@extends('admin.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h1 class="h3 mb-1 text-gray-800">
                Artists
            </h1>

            <p class="text-muted mb-0">
                Explore your favorite artists
            </p>
        </div>

    </div>


    <div class="row">

        @forelse($artists as $artist)

            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">

                <div class="card shadow h-100">

                    <div class="card-body text-center">

                        {{-- Artist Photo --}}
                        @if(!empty($artist->profile_image))

                            <img
                                src="{{ asset($artist->profile_image) }}"
                                alt="{{ $artist->name }}"
                                style="
                                width: 150px;
                                height: 150px;
                                object-fit: cover;
                                border-radius: 50%;
                            "
                                class="mb-3 shadow"
                            >

                        @else

                            <div
                                class="mx-auto mb-3"
                                style="
                                width: 150px;
                                height: 150px;
                                border-radius: 50%;
                                background: #e9ecef;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            "
                            >
                                <i class="fas fa-user fa-4x text-secondary"></i>
                            </div>

                        @endif


                        {{-- Artist Name --}}
                        <h5 class="font-weight-bold text-gray-800 mb-2">
                            {{ $artist->name }}
                        </h5>


                        {{-- Short Biography --}}
                        @if($artist->bio)

                            <p class="text-muted small mb-3">
                                {{ Str::limit($artist->bio, 100) }}
                            </p>

                        @else

                            <p class="text-muted small mb-3">
                                No biography available.
                            </p>

                        @endif


                        {{-- View Profile Button --}}
                        <a
                            href="{{ route('user.artist.details', $artist->id) }}"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fas fa-user mr-1"></i>
                            View Profile
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-light text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    No artists found.
                </div>

            </div>

        @endforelse

    </div>

@endsection
