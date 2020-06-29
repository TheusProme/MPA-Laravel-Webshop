<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // geeft alle producten
    public function show()
    {
        $products = \DB::table('products')->get();

        return view('products', [
            'products' => $products
        ]);
    }

    // geeft product bij de juiste categorie 
    public function showProducts($id)
    {
        $products = \DB::table('products AS p')
            ->where('p.id', $id)
            ->select('p.id', 'p.title', 'p.description', 'p.price', 'p.quantity')
            ->get();

        $categories = \DB::table('categories AS c')
            ->join('category_product', 'category_id', '=', 'c.id')
            ->select('c.id', 'c.title')
            ->where('category_product.product_id', $id)
            ->get();

        return view('showProduct', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    // voegt product toe aan winkelwagen
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    // verwijderd 1x het product
    public function getReduceByOne($id)
    {
        $cart = new Cart();
        $cart->reduceOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }
// verwijderd het product
    public function getRemoveItem($id)
    {
        $cart = new Cart();
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    // voegd 1 toe aan product
    public function getIncreaseByOne(Request $request, $id)
    {
        $product = Product::find($id);
        
        $cart = new Cart();
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    // geeft data van winkelwagen
    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // als wagen leeg is toon een lege winkelwagen
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $cart = new Cart();
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    //formulier ingevud toon succes melding
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $cart = new Cart();

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('firstName');

        // dd($cart->items[1]['item']->id);

        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('home.products')->with('success', 'Successfully purchased products!');
    }
}