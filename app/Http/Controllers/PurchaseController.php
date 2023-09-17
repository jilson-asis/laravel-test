<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    public function __construct()
    {

    }

    public function purchase(Request $request, Product $product)
    {
        $newUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asdfasdf'),
            'type' => $product->type
        ]);

        Purchase::create([
            'user_id'
        ]);
    }

    public function checkout(Request $request, Product $product)
    {
        return view('purchase.checkout');
    }
}
