@extends('admin.layout')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Reviews Management</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Album</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->user_name }}</td>
                            <td>{{ $review->album_title }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">there is no commnt yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
