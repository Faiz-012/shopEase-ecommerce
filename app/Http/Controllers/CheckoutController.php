<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Item_images;
use App\Models\Attribute;
use App\Models\Attributevalue;
use App\Models\OrderItemAttributeValue;
use Razorpay\Api\Api;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        $cartItems = Cart::with('product')->where('user_id', session('user_id'))->get();
        return view('checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required',
        ]);

        $cartItems = Cart::with('product')->where('user_id', session('user_id'))->get();
        $total = 0;

        foreach ($cartItems as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        $order = Order::create([
            'user_id' => session('user_id'),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'country' => $request->country,
            'payment_method' => $request->payment_method,
            'total' => $total,
        ]);

        // create order items and their attribute values
        foreach ($cartItems as $cart) {
            $cart->image = Item_images::where('item_id', $cart->product_id)
                ->where('color', $cart->color)
                ->first()->image_path;

            $orderItem = Order_Item::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'variant_id' => $cart->variant_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);

            // ✅ attributes moved inside the loop
            $attributes = [
                'color' => $cart->color,
                'size'  => $cart->size,
            ];

            foreach ($attributes as $key => $value) {
                if (!empty($value)) {
                    $attributeValue = AttributeValue::where('value', $value)->first();
                    if ($attributeValue) {
                        OrderItemAttributeValue::create([
                            'order_item_id' => $orderItem->id, // ✅ now properly linked
                            'attribute_id' => $attributeValue->attribute_id,
                            'attribute_value_id' => $attributeValue->id,
                        ]);
                    }
                }
            }
        }

        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
        $amount_in_paise = intval(round($total * 100));
        $razorpayOrder = $api->order->create([
            'receipt' => 'order_rcpt_' . $order->id,
            'amount' => $amount_in_paise,
            'currency' => 'INR'
        ]);

        $order->razorpay_order_id = $razorpayOrder['id'];
        $order->save();

        Cart::where('user_id', session('user_id'))->delete();
        session(['last_order_id' => $order->id]);

        return redirect()->route('thankyou')->with('success', 'Order placed Successfully');
    }


    public function verifyPayment(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_id = $request->payment_id;
        $order->status = 'paid';
        $order->save();
        return response()->json(['success' => true]);
    }
}
