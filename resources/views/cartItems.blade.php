<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root {
            --primary: #4a6cfa;
            --primary-dark: #3a5bd9;
            --secondary: #f8f9fa;
            --danger: #ff4757;
            --success: #2ed573;
            --text: #2f3542;
            --text-light: #747d8c;
            --border: #e0e0e0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafb;
            color: var(--text);
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: var(--radius);
            transition: all 0.2s;
        }

        .back-btn:hover {
            background: rgba(74, 108, 250, 0.1);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: var(--text);
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .cart-count {
            color: var(--text-light);
            font-size: 16px;
        }

        .cart-container {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 20px;
            padding: 20px;
            border-bottom: 1px solid var(--border);
            transition: all 0.2s;
        }

        .cart-item:hover {
            background: #fafbff;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100%;
            height: 138px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details {
            padding-right: 15px;
        }

        .item-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text);
        }

        .item-desc {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .item-price {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .item-category {
            font-size: 13px;
            color: var(--text-light);
            background: rgba(116, 125, 140, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-block;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-end;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: var(--secondary);
            color: var(--text);
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .qty-btn:hover {
            background: var(--primary);
            color: white;
        }

        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-btn:disabled:hover {
            background: var(--secondary);
            color: var(--text);
        }

        .quantity {
            font-weight: 600;
            font-size: 16px;
            min-width: 30px;
            text-align: center;
        }

        .item-total {
            font-weight: 700;
            font-size: 18px;
            color: var(--text);
            margin-bottom: 15px;
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 16px;
            padding: 6px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: rgba(255, 71, 87, 0.1);
        }

        .cart-summary {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .summary-label {
            color: var(--text-light);
        }

        .summary-value {
            font-weight: 500;
        }

        .summary-total {
            font-size: 18px;
            font-weight: 700;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .checkout-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: var(--primary-dark);
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .empty-cart i {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-cart p {
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 18px;
        }

        .continue-shopping {
            display: inline-block;
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            font-weight: 500;
            transition: all 0.2s;
        }

        .continue-shopping:hover {
            background: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .item-actions {
                align-items: center;
                margin-top: 15px;
            }

            .quantity-controls {
                margin-bottom: 20px;
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">ShopNow</div>
            <a href="/product-listing" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Continue Shopping
            </a>
        </header>

        <div class="cart-header">
            <h1>Shopping Cart</h1>
            <div class="cart-count">{{ count($cartItem) }} {{ count($cartItem) === 1 ? 'item' : 'items' }}</div>
        </div>

        @if (count($cartItem) > 0)
        <div class="cart-container">
            @foreach ($cartItem as $cart)
            <div class="cart-item">
                @php
                $colorImage = $cart->product->images->where('color', $cart->color)->first();
                $imagePath = $colorImage ? $colorImage->images : $cart->product->images->first()->images;
                @endphp
                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $cart->product->name }}" class="item-image">

                <div class="item-details">
                    <h3 class="item-name">{{ $cart->product->name }}</h3>
                    <p class="item-desc">{{ $cart->product->description }}</p>
                    <input type="hidden" name="variant_id" value="{{ $selectedVariantId ?? '' }}">
                    {{-- color --}}

                    @if (!empty($cart->color))
                    <p>
                        Color:
                        {{ $cart->color ??
                                        (optional(optional($cart->variant?->variantValues)->firstWhere('attributeValue.attribute_id', 1)?->attributeValue)->value ??
                                            '-') }}
                    </p>
                    @endif
                    {{-- size --}}
                    @if (!empty($cart->color))
                    <p>
                        Size:
                        {{ $cart->size ??
                                        (optional(optional($cart->variant?->variantValues)->firstWhere('attributeValue.attribute_id', 2)?->attributeValue)->value ??
                                            '-') }}

                    </p>
                    @endif

                    <p class="item-price">₹{{ $cart->product->price }}</p>
                    <span class="item-category">{{ $cart->product->categories->pluck('name')->join(', ') }}</span>
                </div>

                <div class="item-actions">
                    <div class="quantity-controls">
                        <form action="{{ route('cart.decrease', $cart->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="qty-btn" {{ $cart->quantity == 1 ? 'disabled' : '' }}>
                                <i class="fa-solid fa-minus"></i>
                            </button>
                        </form>

                        <span class="quantity">{{ $cart->quantity }}</span>

                        <form action="{{ route('cart.increase', ['id' => $cart->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="qty-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </form>
                    </div>

                    <div class="item-total">₹{{ $cart->quantity * $cart->product->price }}</div>

                    <form action="{{ route('cart.remove', $cart->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">
                            <i class="fa-solid fa-trash"></i> Remove
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <h3 class="summary-title">Order Summary</h3>

            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">₹{{ $subtotal }}</span>
            </div>

            <div class="summary-row">
                <span class="summary-label">Shipping</span>
                <span class="summary-value">Free</span>
            </div>

            <div class="summary-row">
                <span class="summary-label">Tax</span>
                <span class="summary-value">₹{{ number_format($subtotal * 0.14, 2) }}</span>
            </div>

            <div class="summary-row summary-total">
                <span>Total</span>
                <span>₹{{ number_format($subtotal + $subtotal * 0.14, 2) }}</span>
            </div>
            <a href="{{ route('user.checkout') }}">
                <button class="checkout-btn">Proceed to Checkout</button>
            </a>
        </div>
        @else
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <p>Your cart is empty</p>
            <a href="/product-listing" class="continue-shopping">Continue Shopping</a>
        </div>
        @endif
    </div>

    <script>
        // Add some simple interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const cartItems = document.querySelectorAll('.cart-item');

            cartItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    item.style.transform = 'translateY(-2px)';
                    item.style.boxShadow = '0 6px 16px rgba(0, 0, 0, 0.12)';
                });

                item.addEventListener('mouseleave', () => {
                    item.style.transform = 'translateY(0)';
                    item.style.boxShadow = 'none';
                });
            });

            // Add animation to checkout button
            const checkoutBtn = document.querySelector('.checkout-btn');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('mouseenter', () => {
                    checkoutBtn.style.transform = 'scale(1.02)';
                });

                checkoutBtn.addEventListener('mouseleave', () => {
                    checkoutBtn.style.transform = 'scale(1)';
                });
            }
        });

    </script>
</body>

</html>
