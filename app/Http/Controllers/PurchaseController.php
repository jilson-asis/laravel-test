<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\StripeClient;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:modify-access|purchase-list');
    }

    public function index(Request $request)
    {
        if ($request->user()->can('manage-access')) {
            $purchases = Purchase::latest()->paginate(10);
        } else {
            $purchases = $request->user()->purchases;
        }

        return view('purchase.index', compact('purchases'));
    }

    public function checkout(Request $request, Product $product)
    {
        return view('purchase.checkout', compact('product'));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function purchase(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
        ]);

        $newUser = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $role = Role::findByName($product->type . '-user');

        $newUser->assignRole([$role->id]);

        return $newUser->checkout($product->stripe_price_id, [
            'success_url' => route('purchase.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('purchase.checkout', $product),
        ]);
    }

    public function success(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $intent = $stripe->paymentIntents->retrieve($checkoutSession->payment_intent);
        $paymentMethod = $stripe->paymentMethods->retrieve($intent->payment_method);
        $last4 = $paymentMethod->card->last4;
        $user = User::where('email', $checkoutSession->customer_details->email)->first();

        Purchase::create([
            'user_id' => $user->id,
            'payment_reference' => $checkoutSession->id,
            'last_four' => $last4,
            'payment_intent_id' => $checkoutSession->payment_intent,
            'payment_method_id' => $intent->payment_method,
        ]);

        return view('purchase.success', compact('user'));
    }

    public function cancel(Request $request)
    {
        dd(json_encode($request->toArray()));
    }
}
