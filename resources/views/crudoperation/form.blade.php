<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Product Form</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin: 2rem auto;
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
            padding: 0.5rem 1rem;
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

        select.form-select {
            min-height: 120px;
            /* taller for multiple selection */
            border: 1px solid #ced4da;
            transition: all 0.2s ease-in-out;
        }

        select.form-select:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, .25);
        }

        @media (max-width: 768px) {
            .horizontal-form .col-md-3 {
                margin-bottom: 0.5rem;
            }

            .horizontal-form .col-md-9 {
                margin-bottom: 1rem;
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
                        <a class="nav-link" href="/listing"><i class="fas fa-list me-1"></i> Product Listing</a>
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
                <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Product</h2>
            </div>

            <div class="form-body">
                <div class="welcome-text">
                    <i class="fas fa-user-circle me-2"></i>Hello, Welcome <span
                        style="color: #007bff; font-weight: 600;">{{ session('name') }}</span>
                </div>

                <form action="add" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3">
                            <label for="name" class="form-label">Product Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3">
                            <label for="image" class="form-label">Product Image</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control" id="image" name="file" required>
                            <div class="form-text">Upload a high-quality product image (JPEG, PNG, or GIF)</div>
                        </div>
                    </div>

                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3">
                            <label for="description" class="form-label">Product Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Enter detailed product description" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3">
                            <label for="price" class="form-label">Product Price</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-text" style="font-size: 20px;">₹</span>
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="0.00" required>
                            </div>
                        </div>
                    </div>

                    {{-- Category Dropdown --}}
                    <!-- Include Select2 CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
                        rel="stylesheet" />

                    <!-- Your Category Code -->
                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3 d-flex align-items-center">
                            <label for="category" class="form-label fw-semibold">Category</label>
                        </div>
                        <div class="col-md-9">
                            <select id="category" name="category_ids[]" class="form-select shadow-sm rounded-3 select2"
                                multiple>
                                <option disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Include jQuery and Select2 JS -->

                    {{-- Tags Dropdown --}}
                    <div class="row mb-3 horizontal-form">
                        <div class="col-md-3 d-flex align-items-center">
                            <label for="Tags" class="form-label fw-semibold">Tags</label>
                        </div>
                        <div class="col-md-9">
                            <select id="Tags" name="tag_ids[]" class="form-select shadow-sm rounded-3" multiple>
                                <option disabled>Select Tags</option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">You can select multiple tags</small>
                        </div>
                    </div>

                    {{-- example  --}}

                    <div class="row mt-4">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save me-1"></i> Save
                                Product</button>
                            <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-undo me-1"></i>
                                Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap & jQuery JS -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Activate Select2 -->
    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: "Select Category",
                allowClear: true,
                width: '100%' // responsive
            });
        });

        $(document).ready(function(){
            $('#Tags').select2({
                placeholder:'select Tags',
                allowClear: true,
                width:'100%'
            });
        });
    </script>
</body>

</html>
