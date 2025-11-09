@extends('layouts.dashboard')

@section('title', 'Profile Settings - ElektraFit')

@section('sidebar-class', 'instructor-sidebar')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="{{ route('instructor.dashboard') }}" icon="■" label="Dashboard" />
        <x-nav-item href="#" icon="▲" label="My Clients" />
        <x-nav-item href="#" icon="●" label="Schedule" />
        <x-nav-item href="#" icon="♦" label="Classes" />
        <x-nav-item href="{{ route('instructor.profile') }}" icon="⚙" label="Settings" :active="true" />
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('instructor.logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <span class="nav-icon">→</span>
            <span class="nav-text">Logout</span>
        </button>
    </form>
@endsection

@section('content')
<div class="profile-page">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Profile Settings</h1>
            <p class="page-subtitle">Manage your instructor profile and preferences</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="profile-grid">
        <!-- Profile Photo Section -->
        <div class="profile-card">
            <h2 class="card-title">Profile Photo</h2>
            <p class="card-subtitle">Upload a professional photo to help clients recognize you</p>

            <div class="photo-section">
                <div class="photo-preview">
                    <img src="{{ $instructor->profile_photo_url }}" alt="{{ $instructor->name }}" id="photoPreview">
                    @if($instructor->profile_photo)
                        <button type="button" class="btn-delete-photo" onclick="deletePhoto()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            Remove
                        </button>
                    @endif
                </div>

                <form action="{{ route('instructor.profile.photo.upload') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                    @csrf
                    <div class="upload-area" id="uploadArea">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <p class="upload-text">Click to upload or drag and drop</p>
                        <p class="upload-hint">JPG, PNG or GIF (max. 2MB)</p>
                        <input type="file" name="profile_photo" id="photoInput" accept="image/*" required onchange="previewImage(this)">
                    </div>

                    <button type="submit" class="btn-upload" id="uploadBtn" style="display: none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        Upload Photo
                    </button>
                </form>
            </div>

            <div class="photo-guidelines">
                <h3>Photo Guidelines</h3>
                <ul>
                    <li>Use a clear, professional headshot</li>
                    <li>Face should be clearly visible</li>
                    <li>Good lighting and neutral background</li>
                    <li>Avoid group photos or busy backgrounds</li>
                </ul>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="profile-card">
            <h2 class="card-title">Personal Information</h2>
            <p class="card-subtitle">Your basic profile details</p>

            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <div class="info-value">{{ $instructor->name }}</div>
                </div>

                <div class="info-item">
                    <label>Email</label>
                    <div class="info-value">{{ $instructor->email }}</div>
                </div>

                <div class="info-item">
                    <label>Phone</label>
                    <div class="info-value">{{ $instructor->phone ?? 'Not provided' }}</div>
                </div>

                <div class="info-item">
                    <label>Date of Birth</label>
                    <div class="info-value">{{ $instructor->date_of_birth ? \Carbon\Carbon::parse($instructor->date_of_birth)->format('M d, Y') : 'Not provided' }}</div>
                </div>

                <div class="info-item full-width">
                    <label>Specialization</label>
                    <div class="info-value specialization-badge">{{ $instructor->specialization }}</div>
                </div>

                <div class="info-item">
                    <label>Years of Experience</label>
                    <div class="info-value">{{ $instructor->years_of_experience }} years</div>
                </div>

                @if($instructor->bio)
                <div class="info-item full-width">
                    <label>Bio</label>
                    <div class="info-value">{{ $instructor->bio }}</div>
                </div>
                @endif
            </div>

            <button class="btn-edit-info" onclick="alert('Edit functionality coming soon!')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Edit Information
            </button>
        </div>
    </div>
</div>

<style>
    .profile-page {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
        font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif;
        letter-spacing: -0.015em;
    }

    .page-subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 400;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideIn 0.3s ease-out;
    }

    .alert-success {
        background: rgba(52, 211, 153, 0.1);
        border: 1px solid rgba(52, 211, 153, 0.3);
        color: #34d399;
    }

    .alert-error {
        background: rgba(255, 59, 48, 0.1);
        border: 1px solid rgba(255, 59, 48, 0.3);
        color: #ff3b30;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
    }

    .profile-card {
        background: rgba(10, 14, 39, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(168, 85, 247, 0.2);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        border-color: rgba(168, 85, 247, 0.4);
        box-shadow: 0 0 30px rgba(168, 85, 247, 0.15);
    }

    .card-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.5rem;
        color: #a855f7;
        margin-bottom: 0.5rem;
    }

    .card-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9375rem;
        margin-bottom: 2rem;
    }

    .photo-section {
        margin-bottom: 2rem;
    }

    .photo-preview {
        width: 200px;
        height: 200px;
        margin: 0 auto 2rem;
        position: relative;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid rgba(168, 85, 247, 0.3);
        box-shadow: 0 0 30px rgba(168, 85, 247, 0.2);
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .btn-delete-photo {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(255, 59, 48, 0.9);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        transition: all 0.3s ease;
    }

    .btn-delete-photo:hover {
        background: #ff3b30;
        transform: scale(1.05);
    }

    .upload-area {
        border: 2px dashed rgba(168, 85, 247, 0.3);
        border-radius: 16px;
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        background: rgba(168, 85, 247, 0.05);
    }

    .upload-area:hover {
        border-color: rgba(168, 85, 247, 0.5);
        background: rgba(168, 85, 247, 0.1);
    }

    .upload-area svg {
        color: #a855f7;
        margin-bottom: 1rem;
    }

    .upload-text {
        font-size: 1rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.5);
    }

    #photoInput {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .btn-upload {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.2), rgba(138, 43, 226, 0.2));
        color: #a855f7;
        border: 1.5px solid rgba(168, 85, 247, 0.4);
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-upload:hover {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.3), rgba(138, 43, 226, 0.3));
        border-color: rgba(168, 85, 247, 0.6);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(168, 85, 247, 0.3);
    }

    .photo-guidelines {
        background: rgba(168, 85, 247, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid rgba(168, 85, 247, 0.2);
    }

    .photo-guidelines h3 {
        font-size: 1rem;
        font-weight: 600;
        color: #a855f7;
        margin-bottom: 1rem;
    }

    .photo-guidelines ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .photo-guidelines li {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
        position: relative;
    }

    .photo-guidelines li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #a855f7;
        font-weight: bold;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .info-item.full-width {
        grid-column: 1 / -1;
    }

    .info-item label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .specialization-badge {
        background: rgba(168, 85, 247, 0.15);
        color: #a855f7;
        border-color: rgba(168, 85, 247, 0.3);
        font-weight: 600;
    }

    .btn-edit-info {
        width: 100%;
        padding: 1rem 1.5rem;
        background: rgba(168, 85, 247, 0.1);
        color: #a855f7;
        border: 1.5px solid rgba(168, 85, 247, 0.3);
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-edit-info:hover {
        background: rgba(168, 85, 247, 0.2);
        border-color: rgba(168, 85, 247, 0.5);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
                document.getElementById('uploadBtn').style.display = 'flex';
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deletePhoto() {
        if (!confirm('Are you sure you want to remove your profile photo?')) {
            return;
        }

        fetch('{{ route('instructor.profile.photo.delete') }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete photo. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }

    // Drag and drop functionality
    const uploadArea = document.getElementById('uploadArea');
    const photoInput = document.getElementById('photoInput');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        uploadArea.style.borderColor = 'rgba(168, 85, 247, 0.7)';
        uploadArea.style.background = 'rgba(168, 85, 247, 0.15)';
    }

    function unhighlight() {
        uploadArea.style.borderColor = 'rgba(168, 85, 247, 0.3)';
        uploadArea.style.background = 'rgba(168, 85, 247, 0.05)';
    }

    uploadArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            photoInput.files = files;
            previewImage(photoInput);
        }
    }
</script>
@endsection
