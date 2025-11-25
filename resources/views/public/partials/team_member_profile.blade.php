<div class="authority-profile-layout">
    <div class="authority-image-section">
        @if($member->image_path)
            <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="authority-profile-image">
        @endif
        <div class="authority-name-card">
            <h2 class="authority-name">{{ $member->name }}</h2>
            <p class="authority-position">{{ $member->position }}</p>
        </div>
    </div>
    <div class="authority-info-section">
        <div class="authority-bio-content">
            {!! nl2br(e($member->bio)) !!}
        </div>
    </div>
</div>
