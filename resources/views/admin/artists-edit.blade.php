@extends('admin.layout')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Artist</h1>

        <a href="{{ route('admin.artists.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Back to List
        </a>
    </div>


    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Artist Information
            </h6>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Hata oluştu:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.artists.update', $artist->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- Artist Name --}}
                <div class="form-group mb-4">

                    <label for="name" class="font-weight-bold text-gray-800">
                        Artist Name
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ $artist->name }}"
                        placeholder="Enter artist name"
                        required
                    >

                </div>


                {{-- Biography --}}
                <div class="form-group mb-4">

                    <label for="bio" class="font-weight-bold text-gray-800">
                        Biography
                    </label>

                    <textarea
                        class="form-control"
                        id="bio"
                        name="bio"
                        rows="5"
                        placeholder="Enter artist biography..."
                    >{{ $artist->bio }}</textarea>

                </div>


                {{-- Artist Photo --}}
                <div class="form-group mb-4">

                    <label for="profile_image" class="font-weight-bold text-gray-800">
                        Artist Photo
                    </label>

                    <input
                        type="file"
                        class="form-control-file"
                        id="profile_image"
                        name="profile_image"
                        accept="image/*"
                    >

                    <small class="form-text text-muted">
                        Select a new photo if you want to change the current one.
                    </small>

                </div>


                {{-- Current Photo --}}
                @if(!empty($artist->profile_image))

                    <div class="form-group mb-4">

                        <label class="font-weight-bold text-gray-800">
                            Current Photo
                        </label>

                        <div>
                            <img
                                src="{{ asset($artist->profile_image) }}"
                                alt="{{ $artist->name }}"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                            >
                        </div>

                    </div>

                @endif


                {{-- Save --}}
                <button type="submit" class="btn btn-primary px-4">

                    <i class="fas fa-save mr-1"></i>
                    Update Artist

                </button>

            </form>

        </div>

    </div>

@endsection
