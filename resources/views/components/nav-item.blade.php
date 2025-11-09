<li>
    <a href="{{ $href }}" class="{{ $active ? 'active' : '' }}" {{ $attributes->except(['icon', 'label', 'active']) }}>
        <span class="nav-icon">{{ $icon }}</span>
        <span class="nav-text">{{ $label }}</span>
    </a>
</li>
