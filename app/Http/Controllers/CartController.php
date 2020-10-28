<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\Sendmail;
use App\Order;
use App\Product;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller {
//Product Add to Cart
    public function addToCart(Product $product) {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart');
    }
//Show Cart product
    public function showCart() {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('frontend.cart', compact('cart'));
    }
// update the Cart
    public function updateCart(Request $request, Product $product) {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Cart has been updated');
    }
// Remove the Cart
    public function removeCart(Product $product) {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);

        }
        return redirect()->back()->with('success', 'Cart has been updated');
    }
    //Checkout
    public function checkout($amount) {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        return view('frontend.checkout', compact('amount', 'cart'));
    }
//Payment and Checkout
    public function charge(Request $request) {
        $charge = Stripe::charges()->create([
            'currency'    => "USD",
            'source'      => $request->stripeToken,
            'amount'      => $request->amount,
            'description' => 'Test',
        ]);

        $chargeId = $charge['id'];
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        Mail::to(auth()->user()->email)->send(new Sendmail($cart));

        if ($chargeId) {
            auth()->user()->orders()->create([

                'cart' => serialize(session()->get('cart')),
            ]);

            session()->forget('cart');
            return redirect()->to('/')->with('success', 'Transaction has been completed');

        } else {
            return redirect()->back();
        }

    }
//Show orders For loggedIn User
    public function order() {
        $orders = auth()->user()->orders;
        $carts  = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });
        return view('frontend.order', compact('carts'));
    }
//Show orders For Admin
    public function UserOrder() {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }
    public function vewUserOrder($userid, $orderid) {
        $users  = User::find($userid);
        $orders = $users->orders->where('id', $orderid);
        $carts  = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });
        return view('admin.order.show', compact('carts'));
    }

}
