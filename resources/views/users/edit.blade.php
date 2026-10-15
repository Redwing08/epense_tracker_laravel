@extends('layouts.app')

@section('content')
<div class="container-fluid px-0" style="max-width: 600px;">
    <div class="card border-0 shadow-sm p-4" style="border-radius: 12px; border-top: 4px solid #800000 !important;">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h5 class="fw-bold text-dark mb-0">Modify Personnel Profile</h5>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Directory</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                @foreach($errors->all() as $error) <div>{{ $error }}</div> @endforeach
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">First Name</label>
                <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Middle Name</label>
                <input type="text" name="middlename" class="form-control" value="{{ $user->middlename }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Official Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">New Password (Leave blank to keep current)</label>
                <input type="password" name="password" class="form-control" placeholder="Enter new password if changing">
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Update Identification Image (Binary)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-danger w-100 fw-semibold py-2">Update Personnel Account</button>
        </form>
    </div>
</div>
@endsection