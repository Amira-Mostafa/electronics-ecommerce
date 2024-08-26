<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{



    public function checkout(Request $request)
    {
        $user = User::firstOrCreate(
            [
                'email' => $request->input('email')
            ],
            [
                'password' => Hash::make(Str::random(12)),
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code')
            ]
        );

        try {
            // Create or get existing Stripe customer
            $user->createOrGetStripeCustomer();

            // Generate the PaymentIntent
            $paymentIntent = $user->charge(
                $request->input('amount'),
                $request->input('payment_method_id'),
                [
                    'return_url' => url('/summary') // Redirect URL after successful payment
                ]
            );

            // Retrieve PaymentIntent details
            $paymentIntent = $paymentIntent->asStripePaymentIntent();

            // Log PaymentIntent details for debugging
            \Log::info('PaymentIntent Details: ', $paymentIntent->toArray());

            // Check for charges
            if ($paymentIntent && $paymentIntent->charges && isset($paymentIntent->charges->data) && count($paymentIntent->charges->data) > 0) {
                $transactionId = $paymentIntent->charges->data[0]->id;
                $amount = $paymentIntent->charges->data[0]->amount;

                // Create order
                $order = $user->orders()->create([
                    'transaction_id' => $transactionId,
                    'total' => $amount
                ]);

                // Attach products to the order
                foreach (json_decode($request->input('cart'), true) as $item) {
                    $order->products()->attach($item['id'], ['quantity' => $item['quantity']]);
                }

                $order->load('products');

                // Return successful response
                return response()->json($order);
            } else {
                // Provide detailed error message
                $errorMessage = $paymentIntent ? 'No charges found for PaymentIntent.' : 'PaymentIntent not created.';
                throw new \Exception($errorMessage);
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Checkout error: ' . $e->getMessage());

            // Return error response
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
