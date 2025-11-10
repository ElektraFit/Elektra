@extends('layouts.auth')

@section('title', 'Complete Payment - ElektraFit')

@section('content')
<div class="payment-container">
    <div class="payment-header">
        <img src="{{ asset('images/logo.png') }}" alt="ElektraFit" class="payment-logo">
        <h1>Complete Your Payment</h1>
        <p>You're one step away from joining ElektraFit!</p>
    </div>

    <!-- Plan Summary -->
    <div class="plan-summary">
        <div class="plan-icon">⚡</div>
        <div class="plan-details">
            <h2>{{ $planName }} Membership</h2>
            <div class="plan-price">{{ $currency }} {{ number_format($amount, 0) }}<span>/month</span></div>
        </div>
    </div>

    <!-- Payment Methods Tabs -->
    <div class="payment-methods">
        <button class="payment-tab active" data-method="mpesa" onclick="switchPaymentMethod('mpesa')">
            <span class="tab-icon">📱</span>
            M-Pesa
        </button>
        <button class="payment-tab" data-method="card" onclick="switchPaymentMethod('card')">
            <span class="tab-icon">💳</span>
            Card Payment
        </button>
    </div>

    <!-- M-Pesa Payment Form -->
    <div id="mpesa-form" class="payment-form active">
        <div class="form-info">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <p>Enter your M-Pesa number to receive a payment prompt</p>
        </div>

        <form id="mpesaPaymentForm" onsubmit="processMpesa(event)">
            @csrf
            <input type="hidden" name="plan_name" value="{{ $planName }}">
            <input type="hidden" name="amount" value="{{ $amount }}">

            <div class="form-group">
                <label class="form-label">M-Pesa Phone Number</label>
                <div class="phone-input-group">
                    <span class="phone-prefix">+254</span>
                    <input type="text" 
                           name="phone_number" 
                           id="mpesaPhone"
                           class="form-input phone-input" 
                           placeholder="712345678"
                           pattern="[0-9]{9}"
                           maxlength="9"
                           required>
                </div>
                <small class="form-hint">Enter your Safaricom M-Pesa number</small>
            </div>

            <button type="submit" class="btn-payment" id="mpesaBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
                Pay {{ $currency }} {{ number_format($amount, 0) }} with M-Pesa
            </button>
        </form>
    </div>

    <!-- Card Payment Form -->
    <div id="card-form" class="payment-form">
        <div class="form-info">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                <line x1="1" y1="10" x2="23" y2="10"></line>
            </svg>
            <p>Secure payment with Visa, Mastercard, or American Express</p>
        </div>

        <form id="cardPaymentForm" onsubmit="processCard(event)">
            @csrf
            <input type="hidden" name="plan_name" value="{{ $planName }}">
            <input type="hidden" name="amount" value="{{ $amount }}">

            <div class="form-group">
                <label class="form-label">Cardholder Name</label>
                <input type="text" 
                       name="card_name" 
                       class="form-input" 
                       placeholder="JOHN DOE"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Card Number</label>
                <input type="text" 
                       name="card_number" 
                       id="cardNumber"
                       class="form-input" 
                       placeholder="1234 5678 9012 3456"
                       maxlength="19"
                       required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Expiry Date</label>
                    <input type="text" 
                           name="card_expiry" 
                           id="cardExpiry"
                           class="form-input" 
                           placeholder="MM/YY"
                           maxlength="5"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">CVV</label>
                    <input type="text" 
                           name="card_cvv" 
                           id="cardCvv"
                           class="form-input" 
                           placeholder="123"
                           maxlength="4"
                           required>
                </div>
            </div>

            <button type="submit" class="btn-payment" id="cardBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                Pay {{ $currency }} {{ number_format($amount, 0) }} with Card
            </button>
        </form>
    </div>

    <!-- Security Badge -->
    <div class="security-badge">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        <span>Secure SSL encrypted payment</span>
    </div>
</div>

<style>
    .payment-container {
        max-width: 500px;
        width: 100%;
        position: relative;
        z-index: 10;
    }

    .payment-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .payment-logo {
        height: 3.5rem;
        width: 3.5rem;
        filter: brightness(0) saturate(100%) invert(64%) sepia(100%) saturate(1000%) hue-rotate(170deg);
        margin-bottom: 1rem;
    }

    .payment-header h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(to right, #00bfff, #1cb6d7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .payment-header p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
    }

    .plan-summary {
        background: rgba(0, 191, 255, 0.1);
        border: 1.5px solid rgba(0, 191, 255, 0.3);
        border-radius: 20px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .plan-icon {
        font-size: 3rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .plan-details h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .plan-price {
        font-size: 2rem;
        font-weight: 700;
        color: #00bfff;
        font-family: 'Orbitron', sans-serif;
    }

    .plan-price span {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.6);
        font-weight: 400;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .payment-tab {
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 1rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .payment-tab:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(0, 191, 255, 0.3);
    }

    .payment-tab.active {
        background: rgba(0, 191, 255, 0.15);
        border-color: rgba(0, 191, 255, 0.5);
        color: #00bfff;
    }

    .tab-icon {
        font-size: 1.5rem;
    }

    .payment-form {
        display: none;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 1.5rem;
    }

    .payment-form.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: rgba(0, 191, 255, 0.1);
        border: 1px solid rgba(0, 191, 255, 0.2);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-info svg {
        color: #00bfff;
        flex-shrink: 0;
    }

    .form-info p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin: 0;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .phone-input-group {
        display: flex;
        gap: 0.5rem;
    }

    .phone-prefix {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        padding: 0.9rem 1rem;
        color: #00bfff;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .phone-input {
        flex: 1;
    }

    .form-hint {
        display: block;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .btn-payment {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.3), rgba(0, 128, 255, 0.3));
        color: #00bfff;
        border: 1.5px solid rgba(0, 191, 255, 0.5);
        border-radius: 16px;
        font-weight: 600;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .btn-payment:hover:not(:disabled) {
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.4), rgba(0, 128, 255, 0.4));
        border-color: rgba(0, 191, 255, 0.7);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 191, 255, 0.3);
    }

    .btn-payment:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn-payment.processing {
        position: relative;
    }

    .btn-payment.processing::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid #00bfff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.875rem;
    }

    .security-badge svg {
        color: #00bfff;
    }
</style>

<script>
    function switchPaymentMethod(method) {
        // Update tabs
        document.querySelectorAll('.payment-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        document.querySelector(`[data-method="${method}"]`).classList.add('active');

        // Update forms
        document.querySelectorAll('.payment-form').forEach(form => {
            form.classList.remove('active');
        });
        document.getElementById(`${method}-form`).classList.add('active');
    }

    function processMpesa(event) {
        event.preventDefault();
        
        const btn = document.getElementById('mpesaBtn');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.classList.add('processing');
        btn.innerHTML = 'Processing...';

        const formData = new FormData(event.target);
        const phone = document.getElementById('mpesaPhone').value;
        formData.set('phone_number', '254' + phone);

        fetch('{{ route('payment.mpesa') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Payment failed. Please try again.');
                btn.disabled = false;
                btn.classList.remove('processing');
                btn.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            btn.disabled = false;
            btn.classList.remove('processing');
            btn.innerHTML = originalText;
        });
    }

    function processCard(event) {
        event.preventDefault();
        
        const btn = document.getElementById('cardBtn');
        const originalText = btn.innerHTML;
        
        btn.disabled = true;
        btn.classList.add('processing');
        btn.innerHTML = 'Processing...';

        const formData = new FormData(event.target);

        fetch('{{ route('payment.card') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Payment failed. Please try again.');
                btn.disabled = false;
                btn.classList.remove('processing');
                btn.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            btn.disabled = false;
            btn.classList.remove('processing');
            btn.innerHTML = originalText;
        });
    }

    // Auto-format card number
    document.getElementById('cardNumber')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
    });

    // Auto-format expiry date
    document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
            value = value.slice(0, 2) + '/' + value.slice(2, 4);
        }
        e.target.value = value;
    });

    // Only allow digits in CVV
    document.getElementById('cardCvv')?.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    // Only allow digits in M-Pesa phone
    document.getElementById('mpesaPhone')?.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>
@endsection
