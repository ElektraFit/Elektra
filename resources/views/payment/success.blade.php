@extends('layouts.auth')

@section('title', 'Payment Successful - ElektraFit')

@section('content')
<div class="success-container">
    <!-- Success Icon -->
    <div class="success-icon">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
    </div>

    <!-- Success Message -->
    <h1>Payment Successful!</h1>
    <p class="success-subtitle">Welcome to ElektraFit {{ ucfirst($payment->plan_name) }} Membership</p>

    <!-- Payment Receipt -->
    <div class="receipt-card">
        <div class="receipt-header">
            <span>Payment Receipt</span>
            <span class="receipt-status">✓ Completed</span>
        </div>

        <div class="receipt-details">
            <div class="receipt-row">
                <span class="receipt-label">Transaction ID</span>
                <span class="receipt-value">{{ $payment->transaction_id }}</span>
            </div>

            @if($payment->payment_method === 'mpesa' && $payment->mpesa_receipt)
            <div class="receipt-row">
                <span class="receipt-label">M-Pesa Receipt</span>
                <span class="receipt-value">{{ $payment->mpesa_receipt }}</span>
            </div>
            @endif

            <div class="receipt-row">
                <span class="receipt-label">Plan</span>
                <span class="receipt-value">{{ ucfirst($payment->plan_name) }} Membership</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Payment Method</span>
                <span class="receipt-value">
                    @if($payment->payment_method === 'mpesa')
                        📱 M-Pesa
                    @elseif($payment->payment_method === 'card')
                        💳 Card Payment
                        @php
                            $details = is_string($payment->payment_details) 
                                ? json_decode($payment->payment_details, true) 
                                : $payment->payment_details;
                        @endphp
                        @if(isset($details['card_last4']))
                            (•••• {{ $details['card_last4'] }})
                        @endif
                    @else
                        {{ ucfirst($payment->payment_method) }}
                    @endif
                </span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Date & Time</span>
                <span class="receipt-value">{{ $payment->paid_at->format('M d, Y - h:i A') }}</span>
            </div>

            @if($user->membership_end_date)
            <div class="receipt-row">
                <span class="receipt-label">Membership Valid Until</span>
                <span class="receipt-value" style="color: #22c55e; font-weight: 600;">{{ $user->membership_end_date->format('M d, Y') }}</span>
            </div>
            @endif

            <div class="receipt-divider"></div>

            <div class="receipt-row total">
                <span class="receipt-label">Amount Paid</span>
                <span class="receipt-value">KSh {{ number_format($payment->amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Membership Benefits -->
    <div class="benefits-card">
        <h2>Your {{ ucfirst($payment->plan_name) }} Benefits</h2>
        <div class="benefits-grid">
            @if($payment->plan_name === 'basic')
                <div class="benefit-item">
                    <span class="benefit-icon">🏋️</span>
                    <span>Access to gym floor</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">📱</span>
                    <span>Mobile app access</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">📊</span>
                    <span>Basic progress tracking</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">💪</span>
                    <span>Standard equipment</span>
                </div>
            @elseif($payment->plan_name === 'premium')
                <div class="benefit-item">
                    <span class="benefit-icon">⭐</span>
                    <span>All Basic features</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">👥</span>
                    <span>Group training classes</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">🥗</span>
                    <span>Nutrition planning</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">🎯</span>
                    <span>Advanced analytics</span>
                </div>
            @elseif($payment->plan_name === 'elite')
                <div class="benefit-item">
                    <span class="benefit-icon">👑</span>
                    <span>All Premium features</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">🏆</span>
                    <span>Personal training sessions</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">🧘</span>
                    <span>Spa & recovery access</span>
                </div>
                <div class="benefit-item">
                    <span class="benefit-icon">⚡</span>
                    <span>Priority equipment</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('dashboard') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Go to Dashboard
        </a>
        <button onclick="window.print()" class="btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                <rect x="6" y="14" width="12" height="8"></rect>
            </svg>
            Print Receipt
        </button>
    </div>

    <!-- Support Info -->
    <div class="support-info">
        <p>Need help? Contact us at <a href="mailto:support@elektrafit.com">support@elektrafit.com</a></p>
    </div>
</div>

<style>
    .success-container {
        max-width: 600px;
        width: 100%;
        position: relative;
        z-index: 10;
        text-align: center;
    }

    .success-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
        background: rgba(34, 197, 94, 0.15);
        border: 2px solid rgba(34, 197, 94, 0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: successPop 0.6s ease-out;
    }

    .success-icon svg {
        color: #22c55e;
        animation: checkmark 0.8s ease-out 0.3s both;
    }

    @keyframes successPop {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes checkmark {
        0% { stroke-dasharray: 50; stroke-dashoffset: 50; }
        100% { stroke-dasharray: 50; stroke-dashoffset: 0; }
    }

    .success-container h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(to right, #22c55e, #16a34a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .success-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.125rem;
        margin-bottom: 2.5rem;
    }

    .receipt-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .receipt-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .receipt-header span:first-child {
        font-weight: 600;
        color: #ffffff;
        font-size: 1.125rem;
    }

    .receipt-status {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .receipt-details {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .receipt-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .receipt-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    .receipt-value {
        color: #ffffff;
        font-weight: 500;
        text-align: right;
        max-width: 60%;
        word-break: break-word;
    }

    .receipt-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 0.5rem 0;
    }

    .receipt-row.total {
        margin-top: 0.5rem;
    }

    .receipt-row.total .receipt-label {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
    }

    .receipt-row.total .receipt-value {
        color: #00bfff;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .benefits-card {
        background: rgba(0, 191, 255, 0.1);
        border: 1.5px solid rgba(0, 191, 255, 0.3);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .benefits-card h2 {
        color: #00bfff;
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
    }

    .benefit-icon {
        font-size: 1.5rem;
    }

    .benefit-item span:last-child {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .btn-primary, .btn-secondary {
        padding: 1rem 1.5rem;
        border-radius: 16px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.3), rgba(0, 128, 255, 0.3));
        color: #00bfff;
        border: 1.5px solid rgba(0, 191, 255, 0.5);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.4), rgba(0, 128, 255, 0.4));
        border-color: rgba(0, 191, 255, 0.7);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 191, 255, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.25);
    }

    .support-info {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.875rem;
    }

    .support-info a {
        color: #00bfff;
        text-decoration: none;
    }

    .support-info a:hover {
        text-decoration: underline;
    }

    @media print {
        .action-buttons, .support-info {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .benefits-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }

        .success-icon {
            width: 100px;
            height: 100px;
        }

        .success-icon svg {
            width: 60px;
            height: 60px;
        }
    }
</style>
@endsection
