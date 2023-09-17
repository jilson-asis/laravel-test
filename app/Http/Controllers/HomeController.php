<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $stripe = Cashier::stripe();
//        $stripeProducts = $stripe->products->all();
//
//        $stripePrices = $stripe->prices->all();
//        $products = [];
//        $priceMap = [];
//
//        foreach ($stripePrices as $stripePrice) {
//            $priceMap[$stripePrice->product] = [
//                'amount' => $stripePrice->unit_amount,
//                'pid' => $stripePrice->id
//            ];
//        }
//
//        foreach ($stripeProducts as $stripeProduct) {
//            $products[] = [
//                'name' => $stripeProduct->name,
//                'description' => $stripeProduct->description,
//                'price' => number_format($priceMap[$stripeProduct->id]['amount']/100, 2),
//                'images' => $stripeProduct->images,
//                'pid' => $priceMap[$stripeProduct->id]['pid'],
//            ];
//        }
//
//        $products = json_decode(json_encode($products));

        $products = Product::latest()->paginate(10);

        return view('home', compact('products'));
    }
}
