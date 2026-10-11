@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Expense Dashboard</h4>
            <p class="text-muted small mb-0">Real-time expense analytics</p>
        </div>
        <a href="{{ route('expenses.index') }}" class="btn btn-danger btn-sm px-3 fw-semibold shadow-sm">
            + Record New Expense
        </a>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Disbursed -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-left: 4px solid #800000 !important; border-radius: 10px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase" style="font-size: 0.72rem;">Total Disbursed</small>
                        <h3 class="fw-bold text-danger mb-0 mt-1">₱ {{ number_format($totalExpenses, 2) }}</h3>
                    </div>
                    <div class="bg-light text-danger rounded-circle p-3 fs-4">₱</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Transactions -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-left: 4px solid #c5a059 !important; border-radius: 10px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase" style="font-size: 0.72rem;">Transactions Logged</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalTransactions }}</h3>
                    </div>
                    <div class="bg-light text-warning rounded-circle p-3 fs-4">📊</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Active Categories -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-white" style="border-left: 4px solid #198754 !important; border-radius: 10px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold text-uppercase" style="font-size: 0.72rem;">Linked Categories</small>
                        <h3 class="fw-bold text-dark mb-0 mt-1">{{ $totalCategories }}</h3>
                    </div>
                    <div class="bg-light text-success rounded-circle p-3 fs-4">📁</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left Column: Category Expenditure Breakdown -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 10px;">
                <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">Category Spending Allocation</h6>
                @forelse($categoriesBreakdown as $cat)
                    @php
                        $spent = $cat->expenses_sum_amount ?? 0;
                        $percentage = $totalExpenses > 0 ? ($spent / $totalExpenses) * 100 : 0;
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-semibold text-dark small">{{ $cat->name }}</span>
                            <span class="text-muted small">₱ {{ number_format($spent, 2) }} ({{ number_format($percentage, 1) }}%)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">No category data recorded.</p>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Recent Transactions Activity -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 10px;">
                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <h6 class="fw-bold text-dark mb-0">Recent Disbursement Activity</h6>
                    <a href="{{ route('expenses.index') }}" class="small text-danger fw-semibold text-decoration-none">View All Ledger →</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-muted" style="font-size: 0.75rem;">
                                <th>PARTICULARS</th>
                                <th>CATEGORY</th>
                                <th class="text-end">AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentExpenses as $exp)
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-dark small">{{ $exp->title }}</div>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ date('M d, Y', strtotime($exp->expense_date)) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $exp->category->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-danger small">₱{{ number_format($exp->amount, 2) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3 text-muted small">No recent activity.</td>
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