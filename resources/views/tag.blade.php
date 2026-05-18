<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Master Table - Product Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --success-color: #27ae60;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .heading {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Overlay background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
            display: none;
            justify-content: center;
            align-items: flex-start;
            z-index: 1000;
        }

        /* Popup form card */
        .popup-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.4s ease-in-out;
        }

        .overlay.show {
            display: flex;
        }

        .popup-card.show {
            transform: translateY(0);
            opacity: 1;
        }

        .form-label {
            font-weight: 600;
        }

        .tag-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            background-color: #e0f7fa;
            color: #006064;
            border: 1px solid #b2ebf2;
        }
        table tr:hover td{
            background-color: rgb(229, 225, 225);
            cursor: pointer;
        }
        
    </style>
</head>
    
<body>
    <div class="container mt-4">
        <div class="heading">
            <h3><i class="fa-solid fa-tags"></i> Tags Master Table</h3>
            <h5>Manage All Product Tags In One Place</h5>
        </div>
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif
        <!-- Show tags -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list"></i> All Tags</span>
                <button class="btn btn-sm btn-success" id="addNewTagBtn">
                    <i class="fas fa-plus"></i> Add New Tag
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tag Name</th>
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td >{{ $tag->id }}</td>
                                    <td class="tagid"><span class="tag-badge">{{ $tag->name }}</span></td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td>
                                        <a href="{{ route('RemoveTags', $tag->id) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Form -->
    <div class="overlay" id="overlay">
        <div class="popup-card" id="popupCard">
            <form action="{{ route('tagstore') }}" method="post">
                @csrf
                <h4 class="mb-3">Create Tag</h4>
                <div class="mb-3">
                    <label class="form-label">Tag Name *</label>
                    <input type="text" class="form-control" placeholder="Enter Tag Name" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" placeholder="Tag Slug" name="slug">
                    <div class="form-text">Leave blank to auto-generate from tag name</div>
                </div>
                <button type="button" id="cancelBtn" class="btn btn-danger">Cancel</button>
                <button type="submit" class="btn btn-success">Save Tag</button>
            </form>
        </div>
    </div>

    <script>
        const addNewTagBtn = document.getElementById("addNewTagBtn");
        const overlay = document.getElementById("overlay");
        const popupCard = document.getElementById("popupCard");
        const cancelBtn = document.getElementById("cancelBtn");

        addNewTagBtn.addEventListener("click", () => {
            overlay.classList.add("show");
            setTimeout(() => popupCard.classList.add("show"), 50);
        });

        cancelBtn.addEventListener("click", () => {
            popupCard.classList.remove("show");
            setTimeout(() => overlay.classList.remove("show"), 400);
        });
    </script>
    {{-- paginate --}}
    <div class="d-flex justify-content-center mt-4">
    {{ $tags->links('pagination::bootstrap-5') }}
</div>

</body>

</html>
