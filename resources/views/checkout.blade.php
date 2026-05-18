<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Your Store</title>
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
            position: relative;
        }

        .page-header h3 {
            font-size: 32px;
            color: #2c3e50;
            font-weight: 700;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .page-header h3::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            border-radius: 2px;
        }

        /* Alert */
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 5px solid #28a745;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert::before {
            content: "✓";
            font-weight: bold;
            font-size: 18px;
        }

        /* Layout */
        .checkout-layout {
            display: flex;
            flex-direction: row-reverse;
            gap: 30px;
        }

        .order-summary {
            flex: 1;
            min-width: 300px;
        }

        .shipping-form {
            flex: 1;
            min-width: 300px;
        }

        /* Order Summary */
        .summary-card {
            background: white;
            width: 700px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .summary-card h3 {
            font-size: 22px;
            margin-bottom: 25px;
            color: #2c3e50;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-card h3::before {
            content: "📦";
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid #eaeaea;
            font-weight: 600;
            color: #555;
            background-color: #f8f9fa;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #eaeaea;
            transition: background-color 0.2s;
        }

        tr:hover td {
            background-color: #f8f9fa;
        }

        .total-row {
            background-color: #f1f8ff;
            font-weight: 600;
        }

        .total-row td {
            border-bottom: none;
            padding-top: 18px;
            font-size: 18px;
            color: #2c3e50;
        }

        /* Form Styles */
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .form-card h3 {
            font-size: 22px;
            margin-bottom: 25px;
            color: #2c3e50;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card h3::before {
            content: "🚚";
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #495057;
            font-size: 15px;
        }

        input,
        select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #fdfdfd;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background-color: white;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Button */
        .btn {
            display: block;
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        .btn:hover::after {
            left: 100%;
        }

        .razorpay-payment-button {
            display: block;
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .razorpay-payment-button:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            transform: translateY(-2px);
        }

        /* Payment Method Styling */
        .payment-method {
            margin-top: 10px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
        }

        /* Make table responsive */
        .summary-card table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            overflow: hidden;
        }

        .summary-card table th,
        .summary-card table td {
            text-align: left;
            padding: 12px 2px;
            word-wrap: break-word;
            /* Wrap long text */
        }

        /* Product Image Styling */
        .summary-card table td img {
            width: 80px;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
            display: block;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .summary-card table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .summary-card table td,
            .summary-card table th {
                min-width: 100px;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .checkout-layout {
                flex-direction: column;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .page-header h3 {
                font-size: 28px;
            }

            .summary-card,
            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <div class="page-header">
            <h3>Checkout</h3>
        </div>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="checkout-layout">
            <!-- Order Summary Section -->
            <div class="order-summary">
                <div class="summary-card">
                    <h3>Order Summary</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Product-Image</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Tax (14%)</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach ($cartItems as $cart)
                                @php
                                    $price = $cart->product->price;
                                    $quantity = $cart->quantity;
                                    $subtotal = $price * $quantity;
                                    $tax = $subtotal * 0.14; // 14% tax
                                    $total = $subtotal + $tax;
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td style="display: flex; align-items: center; gap: 12px;">
                                        <img src="{{ asset('storage/' . $cart->image) }}" alt="Product Image">
                                        <div>

                                            <small style="color: #777;">{{ $cart->product->category ?? '' }}</small>
                                        </div>
                                    </td>
                                    {{-- <td>
                                        @php
                                            $color = $cart->attributeValue->firstWhere('attribute_name', 'color');
                                        @endphp
                                        {{ $color->attribute_value ?? '-' }}
                                    </td>

                                    <td>
                                        @php
                                            $size = $cart->attributeValue->firstWhere('attribute_name', 'size');
                                        @endphp
                                        {{ $size->attribute_value ?? '-' }}
                                    </td> --}}
                                    <td>{{ $cart->color ?? '-' }}</td>
                                    <td>{{ $cart->size ?? '-' }}</td>

                                    <td>{{ $quantity }}</td>
                                    <td>₹{{ number_format($price, 2) }}</td>
                                    <td>₹{{ number_format($tax, 2) }}</td>
                                    <td><strong>₹{{ number_format($total, 2) }}</strong></td>
                                </tr>
                            @endforeach
                            <tr class="total-row">
                                <td colspan="6" style="text-align:right;"><strong>Grand Total:</strong></td>
                                <td><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Shipping Form Section -->
            <div class="shipping-form">
                <div class="form-card">
                    <h3>Shipping Details</h3>
                    <form action="{{ route('checkout.placeorder') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" placeholder="Enter your full name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="Enter your email address" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" placeholder="Enter your complete address" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="text" name="phone" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" name="city" placeholder="Enter your city" required>
                            </div>

                            <div class="form-group">
                                <label for="pincode">Pincode:</label>
                                <input type="text" name="pincode" placeholder="Enter pincode" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" name="country" placeholder="Enter your country" required>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Payment Method:</label>
                            <select name="payment_method" required>
                                <option value="">-- Select Payment Method --</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="online">Online Payment</option>
                            </select>
                            <div class="payment-method">
                                <small>Secure payment processing. Your financial details are encrypted and
                                    protected.</small>
                            </div>
                        </div>
                        @php
                            $amount_in_rupees = $total + $tax;
                            $amount_in_paise = intval(round($amount_in_rupees * 100));
                        @endphp
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY_ID') }}"
                            data-amount="{{ $amount_in_paise }}" data-currency="INR" data-name="Faizan Store" data-description="Order Payment"
                            data-buttontext="pay with Razorpay"
                            data-image="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png"
                            data-name="{{ $request->name ?? '' }}" data.notes.customer-email="{{ $request->email ?? '' }}"
                            data.notesd.product-name="shirt" data-prefill.contact="{{ $request->phone ?? '' }}" prefied-name="faizan Tasawala">
                        </script>
                        <script>
                            var option = {
                                "handler": function(response) {
                                    fetch("{{ route('razorpay.verify') }}", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON,
                                            stringify({
                                                payment_id: response.razorpay_payment_id,
                                                order_id: "{{ session('last_order_id') ?? '' }}"
                                            })
                                        }).then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert('payment is successfull!');
                                                window.location.href = "{{ route('thankyou') }}"
                                            }
                                        });
                                }
                            }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
