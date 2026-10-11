@extends('layouts.app')

@section('content')
<div class="container-fluid px-0" style="max-width: 700px;">
    <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h5 class="fw-bold text-dark mb-0">Modify Categories Record</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Ledger</a>
        </div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Category</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
           

            <button type="submit" class="btn btn-danger w-100 fw-semibold py-2">Update Categories</button>
        </form>
    </div>
</div>
@endsection