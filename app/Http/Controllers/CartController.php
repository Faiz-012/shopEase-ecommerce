<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item_images;
use App\Models\ProductVariant;
use App\Models\AttributeValue;

class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {

        $userId = session('user_id');
        $variant_id = $request->variant_id;
        $color = $request->input('color') ?: $request->input('selected_color');
        $size = $request->input('size') ?: $request->input('selected_size');


        if (!$variant_id && $color && $size) {
            $variant = ProductVariant::where('product_id', $id)
                ->whereHas('variantValues.attributeValue', function ($q) use ($color) {
                    $q->where('attribute_id', 1)->where('value', $color);
                })
                ->whereHas('variantValues.attributeValue', function ($q) use ($size) {
                    $q->where('attribute_id', 2)->where('value', $size);
                })
                ->first();

            $variant_id = $variant?->id;
        }

        // find image according to color
        $variantImage = Item_images::where('item_id',$id)->where('color',$color)->first();
        $imagepath = $variantImage ? $variantImage->images : null;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $id);
        if ($variant_id) {
            $cartItem->where('variant_id', $variant_id);
        } else {
            $cartItem->whereNull('variant_id')
                ->where('color', $color)
                ->where('size', $size);
        }
        $cartItem = $cartItem->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'variant_id' => $variant_id,
                'color' => $color,
                'size' => $size,
                'quantity' => 1,
                'image' => $imagepath,
            ]);
        }
        return redirect()->back();
    }

    public function showCart()
    {
        $cartItem = Cart::with('product', 'variant.variantValues.attributeValue')->where('user_id', session('user_id'))->get();
        $cartCount = $cartItem->count();

        $subtotal = $cartItem->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });
        return view('cartItems', compact('cartItem', 'subtotal', 'cartCount'));
    }
    public function increseQty($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity += 1;
        $cartItem->save();
        return back();
    }

    public function decreaseQty($id)
    {
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
        return back();
    }

    public function removeCartItem($id)
    {
        $cartItem = Cart::destroy($id);
        if ($cartItem) {
            return redirect()->route('cart.show')->with('success', 'cart Item has been removed');
        } else {
            return back()->with('error', 'Operation failed');
        }
    }
}
