@extends('layouts.app')

@section('content')
<div class="container-fluid px-0" style="max-width: 700px;">
    <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h5 class="fw-bold text-dark mb-0">Modify Transaction Record</h5>
            <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary btn-sm">← Back to Ledger</a>
        </div>

        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Transaction Title / Payee</label>
                <input type="text" name="title" class="form-control" value="{{ $expense->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Amount (₱)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light">₱</span>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ $expense->amount }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Expense Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Transaction Date</label>
                <input type="date" name="expense_date" class="form-control" value="{{ $expense->expense_date }}" required>
            </div>

            <button type="submit" class="btn btn-danger w-100 fw-semibold py-2">Update Transaction</button>
        </form>
    </div>
</div>
@endsection