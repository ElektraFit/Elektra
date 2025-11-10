<div class="membership-card {{ $popular ? 'popular' : '' }}"><div>

    <h3>{{ $title }}</h3>    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->

    <div class="membership-price">{{ $price }}<span>/month</span></div></div>
    <p class="membership-description">{{ $description }}</p>
    <ul class="membership-features">
        @foreach($features as $feature)
            <li>{{ $feature }}</li>
        @endforeach
    </ul>
    <a href="{{ route('register', ['plan' => strtolower($title)]) }}" class="membership-button">Choose {{ $title }}</a>
</div>
