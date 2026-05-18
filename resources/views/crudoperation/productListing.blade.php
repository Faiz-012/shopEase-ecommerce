<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Premium Product Listing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

@if(isset($message))
    <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
        <div class="alert alert-warning text-center fs-4 px-5 py-4 shadow">
            {{ $message }}
        </div>
    </div>
@endif

@if(session('message'))
<script>
    alert("{{ session('message') }}")
</script>
@endif
    <div class="container">
        <div class="header">
            <h1>Product Inventory</h1>
            <a href="/form" class="add-product-btn">
                <i class="fas fa-plus"></i>
                Add Product
            </a>
        </div>

        <form action="search-data" method="get" class="search-form">

            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>

        <table class="product-table">
            <form action="delete-mutiple-records" method="post">
                @csrf
                <button type="submit" class="bulk-delete-btn"
                    onclick="return confirm('Are you sure you want to delete selected items?')">
                    <i class="fas fa-trash"></i> Delete Selected
                </button>

                <thead>
                    <tr>
                        <th>Selection</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $products)
                        <tr>
                            <td>
                                <div> <input type="checkbox" name="ids[]" value="{{ $products->id }}"></div>
                            </td>
                            <td>
                                <div class="product-name">{{ $products->name }}</div>

                            <td>
                                <img src="{{ asset($products->image) }}" alt="Product Image" class="product-image">
                            </td>
                            <td>
                                <div class="product-description">{{ $products->description }}</div>
                            </td>
                            <td>
                                <div class="product-price">₹ {{ number_format($products->price, 2) }}</div>
                            </td>

                            {{-- category --}}
                            <td>
                                @forelse ($products->categories as $category)
                                    <span
                                        class="inline-block bg-green-100 text-green-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded">
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-400">No categories</span>
                                @endforelse
                            </td>
                            {{-- Tags --}}
                            <td>
                                @forelse ($products->tags as $tag)
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded">
                                        {{ $tag->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-400">No tags</span>
                                @endforelse
                            </td>


                            <td>
                                <div class="product-date">{{ $products->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ url('edit-product/' . $products->id) }}" class="action-btn edit-btn"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ 'delete-data/' . $products->id }}" class="action-btn delete-btn"
                                        title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </form>
        </table>


        {{-- Sirf tab dikhana jab paginate use ho raha ho --}}
        @if (method_exists($product, 'links'))
            <div class="mt-3">
                {{ $product->links() }}
            </div>
        @endif



    </div>
</body>
<script>
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            checkbox.closest('tr').classList.toggle('selected-row', checkbox.checked);
        });
    });
</script>

</html>


