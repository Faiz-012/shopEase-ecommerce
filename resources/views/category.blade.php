<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Master Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Overlay background */
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease-out;
        }

        /* Sliding Card */
        #overlay .card {
            width: 500px;
            margin-top: 50px;
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.4s ease-out;
            transition-delay: 0.1s;
        }

        #overlay.show {
            opacity: 1;
            visibility: visible;
        }

        #overlay.show .card {
            transform: translateY(0);
            opacity: 1;
        }

        .card {
            text-align: center;
        }

        .cat-badge {
            background-color: #e0f7fa;
            color: #006064;
            border: 1px solid #b2ebf2;
            padding: 5px 12px;
            border-radius: 17px;
        }
    </style>
</head>

<body class="bg-light">

    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
    <div class="container mt-4">
        <!-- Header Card -->
        <div class="card shadow-sm rounded-3 mb-4">
            <div class="card-body bg-dark text-white rounded-3">
                <h3 class="mb-0"><i class="fas fa-list"></i> Category Master Table</h3>
                <small>Manage All Product Categories In One Place</small>
            </div>
        </div>

        <!-- Action Card -->
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fas fa-table"></i> All Categories</h5>
                    <button id="clicktoOpen" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                </div>

                <!-- Table -->
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $categories)
                            <tr>
                                <td>{{ $categories->id }}</td>
                                <td>
                                    <span class="cat-badge">{{ $categories->name }}</span>
                                </td>
                                <td>{{ $categories->slug }}</td>
                                <td>{{ $categories->created_at }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('RemoveCategory',$categories->id)  }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Overlay with Card Form -->
    <div id="overlay">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Create Category</h5>
                <button id="cancel" class="btn btn-sm btn-light">X</button>
            </div>
            <div class="card-body">
                <form action="{{ route('CreateCategory') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Category Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug:</label>
                        <input type="text" class="form-control" placeholder="Enter Category Slug" name="slug">
                    </div>
                    <button type="button" id="cancel2" class="btn btn-secondary">Cancel</button>
                    <button class="btn btn-primary">Save Category!</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let clicktoOpen = document.getElementById('clicktoOpen');
        let overlay = document.getElementById('overlay');
        let cancel = document.getElementById('cancel');
        let cancel2 = document.getElementById('cancel2');

        clicktoOpen.addEventListener('click', () => {
            overlay.classList.add('show');
            // Prevent body from scrolling when overlay is open
            document.body.style.overflow = 'hidden';
        });

        function closeOverlay() {
            overlay.classList.remove('show');
            // Re-enable body scrolling
            document.body.style.overflow = 'auto';
        }

        cancel.addEventListener('click', closeOverlay);
        cancel2.addEventListener('click', closeOverlay);

        // Close overlay when clicking outside the card
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                closeOverlay();
            }
        });

        // Close overlay with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && overlay.classList.contains('show')) {
                closeOverlay();
            }
        });
    </script>

</body>

</html>
