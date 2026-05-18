<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Product Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    @if (session('success'))
        <script>
            alert("{{ session('success') }}")
        </script>+
    @endif


    <nav class="navbar">
        <a href="#" class="logo">
            <i class="fas fa-shopping-bag logo-icon"></i>
            ShopNow
        </a>

        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-links">
            <li class="nav-item">
                <a href="/product-listing" class="nav-link active">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-tshirt"></i>
                    Men
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-percent"></i>
                    Offers
                </a>
            </li>
        </div>

        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search for products, brands and more...">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="user-actions">
            <button class="user-btn" id="heart">
                <i class="far fa-heart"></i>
            </button>

            <li class="nav-item">
                <a href="{{ route('cart.show') }}" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    Cart
                    @if ($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </li>

            <div class="user-profile">
                <div class="user-avatar">{{ strtoupper(substr(session('user'), 0, 1)) }}</div>
                <span class="user-name">{{ session('user') }}</span>

            </div>
        </div>
    </nav>
    <div class="container">

        <div class="product-container">
            <div class="image-section" id="productImages">
                <!-- Main product image -->
                <img id="mainImage" src="{{ asset('storage/' . $defaultImages->first()->images) }}" alt="Product Image"
                    class="main-image">

                <!-- Multiple images -->
                <div class="thumbnail-container">
                    @foreach ($defaultImages as $img)
                        <img src="{{ asset('storage/' . $img->images) }}" alt="Extra Image" class="thumbnail">
                    @endforeach
                </div>
            </div>

            <div class="details-section">
                <h2 class="product-title"> {{ $productDetails->name }}</h2>

                <div class="rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(4.7/5 based on 1,238 reviews)</span>
                </div>

                <div class="product-price">
                    ₹ {{ $productDetails->price }} <span class="original-price">₹
                        {{ $productDetails->price * 2 }}</span>
                    <span class="discount">50% off</span>
                </div>

                <p class="product-description">
                    {{ $productDetails->description }}
                </p>

                <form action="{{ route('cart.add', $productDetails->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="variant_id" id="variantId" value="{{ $selectedVariantId ?? '' }}">
                    <input type="hidden" name="selected_color" id="selectedColor" value="">
                    <input type="hidden" name="selected_size" id="selectedSize" value="">

                 <div class="product-options">
    {{-- Color Dropdown --}}
    @if ($color->isNotEmpty())
        <div class="option-group">
            <label class="option-label">Colors:</label>
            <div class="custom-select">
                <select name="color" id="colorSelect" class="form-select">
                    <option value="">Select Color</option>
                    @foreach ($color as $colors)
                        @if($colors->value)
                            <option value="{{ $colors->value }}"
                                data-stock="{{ $colors->stock ?? 0 }}"
                                {{ ($selectedColor ?? $defaultColor) == $colors->value ? 'selected' : '' }}>
                                {{ ucfirst($colors->value) }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <br>
    @endif

    {{-- Size Options --}}
    @if ($size->isNotEmpty())
        <div class="option-group">
            <label class="option-label">Size:</label>
            <div class="size-options">
                @foreach ($size as $s)
                    @if($s->value)
                        <input type="radio" name="size" id="size-{{ $s->id }}"
                            value="{{ $s->value }}" class="size-radio"
                            data-stock="{{ $s->stock ?? 0 }}"
                            {{ ($selectedSize ?? '') == $s->value ? 'checked' : '' }}>
                        <label for="size-{{ $s->id }}" class="size-label">{{ $s->value }}</label>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>

                    
                    <div class="benefits">
                        <div class="benefit">
                            <i class="fas fa-truck"></i>
                            <span>Free delivery</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-undo"></i>
                            <span>30-day returns</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-shield-alt"></i>
                            <span>2-year warranty</span>
                        </div>
                    </div>

                    <div class="category-tags">
                        <div class="category">
                            <div class="section-title">
                                <i class="fas fa-tag"></i>
                                <span>Category</span>
                            </div>
                            @foreach ($productDetails->categories as $cat)
                                <span class="cat">{{ $cat->name }}</span>
                            @endforeach
                        </div>

                        <div class="tags">
                            <div class="section-title">
                                <i class="fas fa-hashtag"></i>
                                <span>Tags</span>
                            </div>
                            @foreach ($productDetails->tags as $tag)
                                <span class="tag">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="action-buttons">

                        <button class="btn btn-primary" id="addToCart" type="submit">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                </form>



                <button class="btn btn-secondary">
                    <i class="fas fa-heart"></i> Add to Wishlist
                </button>
            </div>
        </div>
    </div>
    </div>

    <div class="zoom-container" id="zoomContainer">
        <span class="close-zoom" id="closeZoom">&times;</span>
        <img src="" alt="Zoomed Image" class="zoom-image" id="zoomedImage">
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-check-circle"></i> Product added to cart successfully!
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // 🎨 Color change event
            $('#colorSelect').on('change', function() {
                let color = $(this).val();
                let itemId = "{{ $productDetails->id }}";
                $('#selectedColor').val(color);

                if (color) {
                    $.ajax({
                        url: `/get-images-by-color/${itemId}/${color}`,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                let mainImage = data[0];
                                $('#mainImage').attr('src', `/storage/${mainImage}`);

                                let thumbnails = '';
                                data.forEach(img => {
                                    thumbnails +=
                                        `<img src="/storage/${img}" class="thumbnail" alt="Product Image">`;
                                });
                                $('.thumbnail-container').html(thumbnails);

                                $('.thumbnail').on('click', function() {
                                    let newSrc = $(this).attr('src');
                                    $('#mainImage').css('opacity', '0');
                                    setTimeout(() => {
                                        $('#mainImage').attr('src', newSrc).css(
                                            'opacity', '1');
                                    }, 300);
                                });
                            } else {
                                alert('No images found for this color!');
                            }
                        }
                    });
                }
            });

            // 📏 Size change event (independent)
            $('input[name="size"]').on('change', function() {
                $('#selectedSize').val($(this).val());
            });
        });

        // Thumbnail click functionality
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        const heart = document.getElementById('heart');
        let addToCart = document.getElementById('addToCart');
        let notification = document.getElementById('notification');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // fade-out only main image
                mainImage.style.opacity = "0";

                setTimeout(() => {
                    // swap src
                    let tempSrc = mainImage.src;
                    mainImage.src = this.src;
                    this.src = tempSrc;

                    // fade-in main image
                    mainImage.style.opacity = "1";
                }, 300); // duration should match CSS
            });
        });

        addToCart.addEventListener('click', function() {
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        });

        heart.addEventListener('click', function() {
            if (heart.style.backgroundColor === 'pink') {
                heart.style.backgroundColor = '';
            } else {
                heart.style.backgroundColor = 'pink';
            }
        });


        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 &&
                !e.target.closest('.nav-links') &&
                !e.target.closest('.hamburger') &&
                navLinks.classList.contains('active')) {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });

        // Add active class to clicked nav items
        const navItems = document.querySelectorAll('.nav-link');
        navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                if (window.innerWidth <= 992) {
                    hamburger.classList.remove('active');
                    navLinks.classList.remove('active');
                }

                navItems.forEach(i => i.classList.remove('active'));
                e.currentTarget.classList.add('active');
            });
        });


        document.getElementById('colorSelect')?.addEventListener('change', function() {
            const params = new URLSearchParams(window.location.search);
            if (this.value) params.set('color', this.value);
            else params.delete('color');
            // Color change pe images server se filter ho rahi hain to reload karo:
            window.location.search = params.toString();
        });

        document.querySelectorAll('.size-radio').forEach(r => {
            r.addEventListener('change', function() {
                const params = new URLSearchParams(window.location.search);
                if (this.value) params.set('size', this.value);
                else params.delete('size');
                // Size se images nahi badalni to URL ko without reload bhi set kar sakte ho:
                window.history.replaceState({}, '', `${location.pathname}?${params.toString()}`);
            });

        });

        document.getElementById('colorSelect').addEventListener('change',function(){
            let selectedOption = this.options[this.selectedindex];
            let stock = selectedOption.getAttribute('data-stock');
            if(stock === 0){
                alert('this color is out of stock!');
            }
        });
        
    </script>
</body>

</html>
