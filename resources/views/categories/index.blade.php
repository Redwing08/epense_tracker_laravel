@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Expense Categories Setup</h4>
            <p class="text-muted small mb-0">Manage national treasury expenditure classifications</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Add Category Form -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">New Category Entry</h5>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g., Utilities, Procurement" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 fw-semibold py-2">Create Category</button>
                </form>
            </div>
        </div>

        <!-- Categories List -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Active Categories</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-muted" style="font-size: 0.8rem;">
                                <th>CATEGORY NAME</th>
                                <th>LINKED EXPENSES</th>
                                <th>CREATED AT</th>
                                 <th>OPTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td><span class="fw-bold text-dark">{{ $category->name }}</span></td>
                                    <td><span class="badge bg-light text-dark border">{{ $category->expenses_count }} Transactions</span></td>
                                    <td><small class="text-muted">{{ $category->created_at->format('M d, Y') }}</small></td>
                                       <td class="text-end">
                                                <!-- Edit Button -->
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-primary btn-sm px-2 py-1 me-1">Edit</a>

                                             <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1" onclick="return confirm('Delete this category and all its expenses?')">Delete</button>
                                            </form>
                                        </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">No categories created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection