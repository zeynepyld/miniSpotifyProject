@extends('admin.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h1 class="h3 mb-1 text-gray-800">
                {{ $artist->name }}
            </h1>

            <p class="text-muted mb-0">
                Artist Profile
            </p>
        </div>

        <a href="{{ route('user.artists') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i>
            Back to Artists
        </a>

    </div>


    <div class="card shadow mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                {{-- Artist Photo --}}
                <div class="col-md-4 text-center">

                    @if(!empty($artist->profile_image))

                        <img
                            src="{{ asset($artist->profile_image) }}"
                            alt="{{ $artist->name }}"
                            style="
                            width: 250px;
                            height: 250px;
                            object-fit: cover;
                            border-radius: 50%;
                        "
                            class="shadow"
                        >

                    @else

                        <div
                            class="mx-auto"
                            style="
                            width: 250px;
                            height: 250px;
                            border-radius: 50%;
                            background: #e9ecef;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                        >
                            <i class="fas fa-user fa-5x text-secondary"></i>
                        </div>

                    @endif

                </div>


                {{-- Artist Information --}}
                <div class="col-md-8">

                    <h2 class="font-weight-bold text-gray-800">
                        {{ $artist->name }}
                    </h2>

                    <hr>

                    <h5 class="font-weight-bold text-primary">
                        Biography
                    </h5>

                    @if($artist->bio)

                        <p class="text-gray-700" style="line-height: 1.8;">
                            {{ $artist->bio }}
                        </p>

                    @else

                        <p class="text-muted">
                            No biography available.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
