@extends('admin.layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Artist</h1>
        <a href="{{ route('admin.artists.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Artist Information</h6>
        </div>
        <div class="card-body">
            {{-- Formun verileri kaydedecek olan rotaya (store) post edilmesini sağlıyoruz --}}
            <form action="{{ route('admin.artists.store') }}" method="POST">
                @csrf

                <div class="form-group mb-4">
                    <label for="name" class="font-weight-bold text-gray-800">Artist Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter artist name" required>
                </div>

                <div class="form-group mb-4">
                    <label for="bio" class="font-weight-bold text-gray-800">Biography</label>
                    <textarea class="form-control" id="bio" name="bio" rows="5" placeholder="Enter artist biography..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save mr-1"></i> Save Artist
                </button>
            </form>
        </div>
    </div>
@endsection
