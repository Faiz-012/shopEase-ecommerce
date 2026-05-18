<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 2rem;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin: 0 auto;
            max-width: 900px;
        }

        .form-header {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 1rem 2rem;
        }

        .form-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3 0%, #004494 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(90deg, #6c757d 0%, #495057 100%);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: linear-gradient(90deg, #5a6268 0%, #3d4449 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }

        .btn-danger {
            background: linear-gradient(90deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
        }

        .welcome-text {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #007bff;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.15);
            border-color: #007bff;
        }

        .user-info {
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .current-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 5px;
            margin-top: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .image-preview-container {
            margin-top: 15px;
            padding: 10px;
            border: 1px dashed #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .horizontal-form .col-md-3 {
                margin-bottom: 0.5rem;
            }

            .horizontal-form .col-md-9 {
                margin-bottom: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-box-open me-2"></i>ProductHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-plus-circle me-1"></i> Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/listing"><i class="fas fa-list me-1"></i> Product Listing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user me-1"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm ms-2" href="/log-out"
                            onclick="return confirm('Are you sure you want to logout?');">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="form-container">
            <div class="form-header">
                <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Product</h2>
            </div>
            <div class="form-body">
                <div class="welcome-text">
                    <i class="fas fa-info-circle me-2"></i>You are editing: <span
                        style="color: #007bff; font-weight: 600;">{{ $product->name }}</span> (ID: {{ $product->id }})
                </div>

                <form action="/updatefield/{{ $product->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put" />

                    <div class="row mb-4 horizontal-form">
                        <div class="col-md-3">
                            <label for="name" class="form-label">Product Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}" placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="row mb-4 horizontal-form">
                        <div class="col-md-3">
                            <label for="image" class="form-label">Product Image</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text mt-2">Upload a new image to replace the current one (JPEG, PNG, GIF)
                            </div>

                            <!-- Display current image if available -->
                            <div class="image-preview-container mt-3">
                                <label class="form-label">Current Image:</label>
                                <div>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Product Image"
                                        class="current-image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 horizontal-form">
                        <div class="col-md-3">
                            <label for="description" class="form-label">Product Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Enter detailed product description" required>{{ $product->description }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4 horizontal-form">
                        <div class="col-md-3">
                            <label for="price" class="form-label">Product Price</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-text" style="font-size: 19px">₹</span>
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}" placeholder="0.00" required>
                            </div>
                            <div class="form-text">Enter price in India Ruppes..</div>
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="productCategory" class="form-label fw-semibold">Product Category <span
                                class="text-danger">*</span></label>
                        <select name="category_ids[]" id="productCategory" class="form-select shadow-sm rounded-3"
                            multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    {{-- Tags --}}
                    <div class="mb-3">
                        <label for="productTags" class="form-label fw-semibold">Product Tags <span
                                class="text-danger">*</span></label>
                        <select name="tag_ids[]" id="productTags" class="form-select shadow-sm rounded-3" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-9 offset-md-3">
                            <div class="action-buttons">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>
                                    Update Product</button>
                                <a href="/listing" class="btn btn-secondary"><i class="fas fa-times me-1"></i>
                                    Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Body ke end me -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#productCategory').select2({
                placeholder: "Select Categories",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('#productTags').select2({
                placeholder: 'Select Tags',
                allowClear: true
            });
        });
        // Simple image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create or update preview image
                    let preview = document.querySelector('.image-preview-container img');
                    if (!preview) {
                        const container = document.querySelector('.image-preview-container');
                        preview = document.createElement('img');
                        preview.className = 'current-image';
                        container.appendChild(preview);
                    }
                    preview.src = e.target.result;

                    // Update label text
                    document.querySelector('.image-preview-container label').textContent = 'New Image Preview:';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
