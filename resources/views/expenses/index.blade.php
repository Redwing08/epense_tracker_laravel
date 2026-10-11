@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Banking Account Summary Banner / Virtual Card -->
        <div class="row mb-4">
            <div class="col-lg-7 mb-3 mb-lg-0">
                <div class="p-4 h-100 d-flex flex-column justify-content-between text-white" style="background: linear-gradient(135deg, #a61c1c 0%, #660000 100%); border-radius: 12px; box-shadow: 0 10px 25px rgba(153, 0, 0, 0.2);">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-uppercase tracking-wider small text-white-50 fw-semibold">Primary Operating Account</span>
                        <span class="badge bg-light text-danger fw-bold px-2 py-1">PHP ACCOUNT</span>
                    </div>
                    <div class="my-3">
                        <small class="text-white-50 d-block mb-1">Total Disbursed Expenses</small>
                        <h2 class="fw-bold mb-0">₱ {{ number_format($expenses->sum('amount'), 2) }}</h2>
                    </div>
                    <div class="d-flex justify-content-between align-items-end pt-2 border-top border-light border-opacity-25">
                        <small class="text-white-50">Account Holder: <strong>Authorized Signatory</strong></small>
                        <small class="text-white-50">Secured via SSL 256-bit</small>
                    </div>
                </div>
            </div>

            <!-- Quick Metrics / Bank Stats -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 h-100 bg-white" style="border-radius: 12px;">
                    <h6 class="text-muted fw-semibold mb-3">Portfolio Overview</h6>
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-secondary">Total Transactions Recorded</span>
                        <span class="fw-bold text-dark fs-5">{{ $expenses->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary">Active Categories Linked</span>
                        <span class="fw-bold text-dark fs-5">{{ $categories->count() }}</span>
                    </div>
                    <div class="mt-auto pt-3">
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form to Record Expense -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">New Expense Entry</h5>
                    <form action="{{ route('expenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Transaction Title / Payee</label>
                            <input type="text" name="title" class="form-control" placeholder="e.g., Meralco Bill, Office Supplies" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Amount (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">₱</span>
                                <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Expense Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Transaction Date</label>
                            <input type="date" name="expense_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold py-2">Process Transaction</button>
                    </form>
                </div>
            </div>

            <!-- Table to Display Expenses Ledger -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 12px;">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <h5 class="fw-bold text-dark mb-0">Transaction Ledger</h5>
                        <span class="badge bg-light text-secondary border">Real-time Feed</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-secondary" style="font-size: 0.85rem;">
                                    <th>PARTICULARS</th>
                                    <th>AMOUNT</th>
                                    <th>CATEGORY</th>
                                    <th>DATE</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $expense->title }}</div>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-danger">₱{{ number_format($expense->amount, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $expense->category->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ date('M d, Y', strtotime($expense->expense_date)) }}</small>
                                        </td>
                                        <td class="text-end">
                                                <!-- Edit Button -->
                                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-outline-primary btn-sm px-2 py-1 me-1">Edit</a>

                                                <!-- Void / Delete Form -->
                                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm px-2 py-1" onclick="return confirm('Are you sure you want to reverse/delete this transaction?')">Void</button>
                                                </form>
                                            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No transactions recorded in the ledger.</td>
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