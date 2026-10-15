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
            <h5 class="fw-bold text-dark mb-1" style="font-size: 1.15rem;">Official Personnel Registration</h5>
            <p class="text-muted small mb-0">Create your authorized treasury credentials</p>
        </div>

        <!-- Feedback Alerts -->
        @if($errors->any())
            <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger small py-2 px-3 rounded-2 mb-3">
                <div class="fw-bold mb-1">⚠️ Registration Error:</div>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Grid Row for Name Inputs -->
            <div class="row g-2 mb-3">
                <div class="col-md-5">
                    <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">First Name</label>
                    <input type="text" name="firstname" class="form-control bg-light py-2 shadow-none" placeholder="Juan" required value="{{ old('firstname') }}" style="font-size: 0.88rem;">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">M.I.</label>
                    <input type="text" name="middlename" class="form-control bg-light py-2 shadow-none" placeholder="D." value="{{ old('middlename') }}" style="font-size: 0.88rem;">
                </div>
                <div class="col-md-5">
                    <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Last Name</label>
                    <input type="text" name="lastname" class="form-control bg-light py-2 shadow-none" placeholder="Dela Cruz" required value="{{ old('lastname') }}" style="font-size: 0.88rem;">
                </div>
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Official Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0">✉️</span>
                    <input type="email" name="email" class="form-control bg-light border-start-0 py-2 shadow-none" placeholder="signatory@treasury.gov.ph" required value="{{ old('email') }}" style="font-size: 0.88rem;">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Access Password (MD5 Encrypted)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted border-end-0">🔒</span>
                    <input type="password" name="password" class="form-control bg-light border-start-0 py-2 shadow-none" placeholder="Minimum 6 characters" required style="font-size: 0.88rem;">
                </div>
            </div>

            <!-- Profile Identification Image Upload -->
            <div class="mb-4">
                <label class="form-label text-secondary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Identification Image (Binary Blob)</label>
                <input type="file" name="image" class="form-control bg-light py-2 shadow-none" accept="image/*" style="font-size: 0.85rem;">
                <small class="text-muted d-block mt-1" style="font-size: 0.68rem;">Accepted formats: PNG, JPG, JPEG (Max 2MB)</small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn text-white fw-bold py-2 w-100 shadow-sm transition-all" style="background-color: #800000; border-radius: 6px; font-size: 0.9rem;">
                Register Account & Request Credentials
            </button>
        </form>

        <!-- Footer Switch Link -->
        <div class="text-center mt-4 pt-3 border-top">
            <small class="text-muted d-block mb-1">Already registered? <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Sign In Here</a></small>
            <span class="text-secondary opacity-75" style="font-size: 0.65rem;">Bureau of the Treasury • National Identity Portal</span>
        </div>
    </div>
</div>
@endsection