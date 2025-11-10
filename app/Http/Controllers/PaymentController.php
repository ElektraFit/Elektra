<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Show payment page with selected plan
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue');
        }

        // Get selected plan from session
        $selectedPlan = Session::get('selected_plan');
        
        if (!$selectedPlan) {
            return redirect('/')->with('error', 'Please select a membership plan first');
        }

        // Define plan pricing
        $plans = [
            'basic' => ['name' => 'Basic', 'price' => 2500, 'currency' => 'KSh'],
            'premium' => ['name' => 'Premium', 'price' => 5000, 'currency' => 'KSh'],
            'elite' => ['name' => 'Elite', 'price' => 9000, 'currency' => 'KSh'],
        ];

        $planKey = strtolower($selectedPlan);
        $planDetails = $plans[$planKey] ?? $plans['basic'];

        return view('payment.index', [
            'user' => $user,
            'planName' => $planDetails['name'],
            'amount' => $planDetails['price'],
            'currency' => $planDetails['currency'],
        ]);
    }

    /**
     * Process M-Pesa payment
     */
    public function processMpesa(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|regex:/^254[0-9]{9}$/',
            'amount' => 'required|numeric|min:1',
            'plan_name' => 'required|string',
        ]);

        $user = Auth::user();

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'plan_name' => $request->plan_name,
            'amount' => $request->amount,
            'payment_method' => 'mpesa',
            'phone_number' => $request->phone_number,
            'status' => 'pending',
            'transaction_id' => 'TXN' . strtoupper(uniqid()),
        ]);

        // TODO: Integrate with actual M-Pesa API (Safaricom Daraja API)
        // For now, simulate successful payment
        
        // Simulate API call delay
        sleep(2);

        // Mark as completed (in production, this would be done by M-Pesa callback)
        $payment->markAsCompleted(
            'MPESA' . rand(100000, 999999),
            'RC' . rand(1000000000, 9999999999)
        );

        // Activate user membership
        $user->activateMembership($request->plan_name, 1); // 1 month duration

        // Clear selected plan from session
        Session::forget('selected_plan');

        return response()->json([
            'success' => true,
            'message' => 'Payment successful! Welcome to ElektraFit!',
            'payment_id' => $payment->id,
            'redirect' => route('payment.success', $payment->id),
        ]);
    }

    /**
     * Process card payment
     */
    public function processCard(Request $request)
    {
        // Remove spaces from card number for validation
        $cardNumber = str_replace(' ', '', $request->card_number);
        $request->merge(['card_number' => $cardNumber]);

        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiry' => 'required|regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/',
            'card_cvv' => 'required|digits_between:3,4',
            'card_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'plan_name' => 'required|string',
        ]);

        $user = Auth::user();

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'plan_name' => $request->plan_name,
            'amount' => $request->amount,
            'payment_method' => 'card',
            'status' => 'pending',
            'transaction_id' => 'CARD' . strtoupper(uniqid()),
            'payment_details' => [
                'card_last4' => substr($request->card_number, -4),
                'card_type' => $this->detectCardType($request->card_number),
            ],
        ]);

        // TODO: Integrate with payment gateway (Stripe, Flutterwave, etc.)
        // For now, simulate successful payment

        sleep(1);

        $payment->markAsCompleted('CARD' . rand(100000, 999999));

        // Activate user membership
        $user->activateMembership($request->plan_name, 1); // 1 month duration

        Session::forget('selected_plan');

        return response()->json([
            'success' => true,
            'message' => 'Payment successful! Welcome to ElektraFit!',
            'payment_id' => $payment->id,
            'redirect' => route('payment.success', $payment->id),
        ]);
    }

    /**
     * Show payment success page
     */
    public function success($paymentId)
    {
        $payment = Payment::where('id', $paymentId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $user = Auth::user();

        return view('payment.success', compact('payment', 'user'));
    }

    /**
     * Detect card type from number
     */
    private function detectCardType($number)
    {
        if (preg_match('/^4/', $number)) return 'Visa';
        if (preg_match('/^5[1-5]/', $number)) return 'Mastercard';
        if (preg_match('/^3[47]/', $number)) return 'American Express';
        return 'Unknown';
    }

    /**
     * M-Pesa callback (for production use)
     */
    public function mpesaCallback(Request $request)
    {
        // This would be called by Safaricom's servers
        // Log and process the callback data
        
        \Log::info('M-Pesa Callback', $request->all());

        // Find payment and update status
        $transactionId = $request->input('TransactionID');
        $resultCode = $request->input('ResultCode');

        if ($transactionId && $resultCode == 0) {
            $payment = Payment::where('transaction_id', $transactionId)->first();
            if ($payment) {
                $payment->markAsCompleted(
                    $transactionId,
                    $request->input('MpesaReceiptNumber')
                );
            }
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
}
