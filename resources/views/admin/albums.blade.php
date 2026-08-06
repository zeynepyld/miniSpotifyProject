@extends('admin.layout')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Album Management</h1>

        <a href="{{ route('admin.albums.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            Add New Album
        </a>
    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Album List
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" width="100%" cellspacing="0">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Album Title</th>
                        <th>Artist</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($albums as $album)

                        <tr>

                            <td>{{ $album->id }}</td>

                            <td width="90">

                                @if($album->cover_image)

                                    <img src="{{ asset($album->cover_image) }}"
                                         width="70"
                                         height="70"
                                         style="object-fit:cover;border-radius:8px;">

                                @else

                                    <span class="text-muted">No Image</span>

                                @endif

                            </td>

                            <td>
                                <strong>{{ $album->title }}</strong>
                            </td>

                            <td>
                                {{ $album->artist_name }}
                            </td>

                            <td>
                                {{ $album->genre ?? 'N/A' }}
                            </td>

                            <td>

                                <a href="{{ route('admin.albums.edit',$album->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>

                                <a href="{{ route('admin.albums.details',$album->id) }}"
                                   class="btn btn-primary btn-sm">
                                    Details
                                </a>

                                <a href="{{ route('admin.albums.delete',$album->id) }}"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this album?')">

                                    <i class="fas fa-trash"></i>
                                    Delete

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle mr-1"></i>
                                No album data found yet.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
