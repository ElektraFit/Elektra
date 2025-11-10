<div class="stat-card {{ $instructor ? 'instructor-stat-card' : '' }}">
    <div class="stat-icon">
        @if(isset($icon) && is_string($icon))
            {!! $icon !!}
        @else
            {{ $slot }}
        @endif
    </div>
    <div class="stat-value">{{ $value }}</div>
    <div class="stat-label">{{ $label }}</div>
</div>
