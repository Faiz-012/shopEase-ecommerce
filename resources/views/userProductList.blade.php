<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashbord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&family=Baloo+Da+2:wght@400..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <style>
        .nav-cart a {
            color: inherit;
            /* parent ka color le */
            text-decoration: none;
            /* underline hatao */
        }

        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            padding: 20px 10px;
        }

        .pro-details {
            text-decoration: none;
        }

        /* Card design */
        .product-card {
            background: #fff;
            border: 1px solid #eaeaea;

            padding: 12px;
            text-align: left;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Hover effect */
        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Product image */
        .product-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* Product name */
        .product-name {
            font-size: 0.95rem;
            color: #333;
            margin: 5px 0;
            line-height: 2.3;
            height: 38px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: normal;
            overflow: hidden;
        }

        /* Price box */
        .price-box {
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .new-price {
            font-size: 14px;
            color: #212121;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .old-price {
            text-decoration: line-through;
            color: #878787;
            font-size: 0.85rem;
        }

        .discount {
            color: #f9854a;
            font-weight: 500;
            font-size: 12px;
            margin-bottom: 3px;
        }
    </style>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="nav-logo border">
                <div class="logo"></div>
            </div>
            <div class="nav-add border">
                <p class="add-first">Deliver to</p>
                <div class="add-logo">
                    <i class="fa-solid fa-location-dot"></i>
                    <p class="add-secend">India</p>
                </div>
            </div>

            <form action="{{ route('search.prodcut') }}" method="GET">
                <div class="nav-search">
                    <select class="select-opp">
                        <option value="">All</option>
                    </select>
                    <input placeholder="Search Product" class="input-holder" name="search" value="{{ @$search }}">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </form>
            <div class="sign-in border">
                <p><span class="Hello">Hello,sign in</span></p>
                <p class="acc">Account & List</p>
            </div>

            <div class="Return border">
                <form action="logout" method="GET" style="display:inline;">
                    <button
                        style="
                        background-color: transparent;
                        border: none;
                        color: white;
                        font-size: 14px;
                        cursor: pointer;
                        padding: 5px 8px;
                        border-radius: 3px;
                    "
                        onmouseover="this.style.backgroundColor='#232f3e'"
                        onmouseout="this.style.backgroundColor='transparent'">
                        LogOut
                    </button>
                </form>
            </div>

            @if (session()->has('user'))
                <h4>Welcome,{{ session('user') }}👋</h4>
            @endif
            <div class="nav-cart border">
                <a href="{{ route('cart.show') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Cart
                </a>
            </div>

        </div>
        <div class="panel">
            <div class="panel-all">
                <i class="fa-solid fa-bars"></i>
                All
            </div>
            <div class="panel-opp">
                <p class="border">Today's Deals</p>
                <p class="border">Customer Service </p>
                <p class="border">Register</p>
                <p class="border">Gift Card</p>
                {{-- <p class="border">Sell</p> --}}
                <a href="/product-listing" class="border">Home-Page</a>
            </div>
        </div>
    </header>
    <div class="hero-img">
        <div class="text">
            <p>You are on amazon.com. You can also shop on Amazon India for millions of products with fast local
                delivery. <a href="#">Click here to go to amazon.in</a></p>
        </div>
    </div>

    <div class="product-container">
        @foreach ($ProductData as $Product)
            @php
                $oldPrice = $Product->price * 2; // old price
                $newPrice = $Product->price; // new price
                $discount = $oldPrice - $newPrice; // discount
                $discountPercent = round(($discount / $oldPrice) * 100);
            @endphp

            <div class="product-card">
                <a class="pro-details" href="{{ route('detailspro', ['id' => $Product->id]) }}">
                    <img src="{{ asset($Product->image) }}" alt="Product Image" class="product-image">

                    <h3 class="product-name">{{ $Product->name }}</h3>

                    <div class="price-box">
                        <span class="new-price">Rs. {{ $newPrice }}</span>
                        <span class="old-price">Rs. {{ $oldPrice }}</span>
                        <span class="discount">({{ $discountPercent }}% OFF)</span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


    {{-- Pagination --}}
    <div class="flex justify-center mt-6">
        {{ $ProductData->links('pagination::tailwind') }}
    </div>

    <footer>
        <div class="footer-shop">
            Back to top
        </div>
        <div class="footer-panel">
            <ul>
                <p>Get to Know Us</p>
                <a href=""> Careers</a>
                <a href="">Blog</a>
                <a href="">About Amazon</a>
                <a href="">Investor Relations</a>
                <a href="">Amazon Devices</a>
                <a href="">Amazon Science</a>
            </ul>
            <ul>
                <p>Make Money with Us</p>
                <a href=""> Sell products on Amazon</a>
                <a href="">Sell on Amazon Business</a>
                <a href="">Advertise Your Products</a>
                <a href="">Self-Publish with Us</a>
                <a href="">Host an Amazon Hub</a>
                <a href="">See More Make Money with Us</a>
            </ul>
            <ul>
                <p> Amazon Payment Products</p>
                <a href=""> Amazon Business Card</a>
                <a href=""> Shop with Points</a>
                <a href="">About Amazon</a>
                <a href=""> Shop with Points</a>
                <a href=""> Amazon Currency Converter</a>
            </ul>

            <ul>
                <p>Let to Know Us</p>
                <a href=""> Amazon and COVID-19</a>
                <a href="">Your Account</a>
                <a href="">Your Orders</a>
                <a href="">Shipping Rates & Policies</a>
                <a href="">Returns & Replacements</a>
                <a href="">Manage Your Content and Devices</a>
                <a href="">Help</a>
            </ul>
        </div>
        <div class="footer-panel3">
            <div class="amazone-logo"></div>
        </div>
        <div class="footer-panel4">
            <div class="item">
                <a href="">Condition of US</a>
                <a href="">Privacy & Notice</a>
                <a href="">Customer Health Data Privacy Disclosure</a>
            </div>
            <div class="copy">
                © 1996-2024, Amazon.com, Inc. or its affiliates
            </div>
        </div>
    </footer>

</body>

</html>
