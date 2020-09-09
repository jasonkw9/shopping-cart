<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();

        return view('shop')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => $validator->errors(), 'success' => false, 'validation_error' => true]);
        }

        $items = Items::create($data);

        return response(['message' => 'Created successfully', 'success' => true, 'validation_error' => false], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $items)
    {
        //
    }

    public function addToCart($id)
    {
        $items = Items::find($id);

        if (!$items) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "name" => $items->name,
                    "quantity" => 1,
                    "price" => $items->price,
                    "photo" => $items->image
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success-add-to-cart', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success-add-to-cart', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $items->name,
            "quantity" => 1,
            "price" => $items->price,
            "photo" => $items->image
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success-add-to-cart', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $stripeCustomer = Auth::user()->createOrGetStripeCustomer();

        return view('cart');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success-update-cart', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success-remove-cart', 'Product removed successfully');
        }
    }

    public function listAllItems()
    {
        $items = Items::all();

        return view('itemList')->with('items', $items);
    }

    public function getItemDetails($id)
    {
        $details = Items::findOrFail($id);

        return view('itemDetail')->with('details', $details);
    }
}
