@extends('layouts.auth')

@section('content')
<div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 12px;">
    
    <!-- Official Institutional Header Banner -->
    <div class="bg-dark text-white px-4 py-3 text-center border-bottom border-warning" style="border-bottom-width: 3px !important; border-color: #c5a059 !important;">
        <div class="official-seal mb-1">🏛️</div>
        <div class="small text-uppercase fw-bold text-warning tracking-widest" style="font-size: 0.65rem; letter-spacing: 1.5px;">Republic of the Philippines</div>
        <div class="fw-bold" style="font-family: 'Merriweather', serif; font-size: 0.95rem; color: #f8f9fa;">BUREAU OF THE TREASURY</div>
    </div>

    <!-- Card Body Content -->
    <div class="p-4 p-md-4 bg-white">
        
        <div class="mb-4 text-center">
            <h5 class="fw-bold text-dark mb-1" style="font-size: 1.15rem;">Secure Portal Sign-In</h5>
            <p class="text-muted small mb-0">Enter your official credentials to access the ledger system</p>
        </div>

        <!-- Feedback Alerts -->
        @if(session('success'))
            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success small py-2 px-3 rounded-2 mb-3">
                <strong>Success:</strong> {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small py-2 px-3 rounded-2 mb-3">
                <strong>Authentication Failed:</strong> {{ $errors->first() }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Official Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0">✉️</span>
                    <input type="email" name="email" class="form-control bg-light border-start-0 py-2 shadow-none" placeholder="signatory@treasury.gov.ph" required value="{{ old('email') }}" style="font-size: 0.9rem;">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Access Password (MD5 Encrypted)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0">🔒</span>
                    <input type="password" name="password" class="form-control bg-light border-start-0 py-2 shadow-none" placeholder="••••••••••••" required style="font-size: 0.9rem;">
                </div>
            </div>

            <button type="submit" class="btn text-white fw-bold py-2 w-100 shadow-sm transition-all" style="background-color: #800000; border-radius: 6px; font-size: 0.9rem;">
                Authorize & Open Session
            </button>
        </form>

        <!-- Footer Help / Registration Switch -->
        <div class="text-center mt-4 pt-3 border-top">
            <small class="text-muted d-block mb-1">New official personnel? <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Register Account</a></small>
            <span class="text-secondary opacity-75" style="font-size: 0.65rem;">Restricted Government Network • Unauthorized Access Prohibited</span>
        </div>
    </div>
</div>
@endsection