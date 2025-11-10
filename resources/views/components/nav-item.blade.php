<li>
    <a href="{{ $href }}" class="{{ $active ? 'active' : '' }}" {{ $attributes->except(['icon', 'label', 'active']) }}>
        <span class="nav-icon">
            @php($slotContent = trim($slot))
            @if($slotContent !== '')
                {{ $slot }}
            @elseif(!empty($icon))
                {{-- allow passing raw SVG or emoji in icon prop --}}
                {!! $icon !!}
            @endif
        </span>
        <span class="nav-text">{{ $label }}</span>
    </a>
</li>
