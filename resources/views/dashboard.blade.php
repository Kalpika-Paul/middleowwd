<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>

<style>
    /* Table Styling */
    .table,
    .table thead,
    .table tbody,
    .table tr,
    .table th,
    .table td {
        background: transparent !important;
        color: aliceblue;
    }

    /* Input Width */
    .input-length {
        width: 25rem;
    }

    /* Card Styling with Glassmorphism */
    .card {
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 4px 20px rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        backdrop-filter: blur(8px);
        width: fit-content;
        padding: 20px;
        margin: auto;
    }


    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;

        display: flex;
        align-items: center;
        justify-content: center;

        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-box {
        background: #2571bdc3;
        color: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        width: 360px;
        max-height: 90vh;
        overflow-y: auto;

        transform: scale(0.95);
        transition: transform 0.25s ease;
    }

    .modal-overlay.active .modal-box {
        transform: scale(1);
    }
</style>

<body style="background-color:rgb(4, 4, 37)">
    <div class="container mt-5">
        <h1 class="text-white">Product List</h1>
        <h3 class="text-white">Add Product</h3>


        <!-- Add Product Card -->


            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            <div class="card mb-5">
                <div class="card-body d-flex justify-content-center mt-4">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-white">Name</label>
                            <input type="text" class="form-control input-length" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Price</label>
                            <input type="text" class="form-control input-length" name="price" value="{{ old('price') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Images</label>
                            <input type="file" class="form-control input-length" name="images[]" id="imagesInput"
                                multiple>
                            <div id="imagePreview" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Purchase Date</label>
                            <input type="date" class="form-control input-length" name="date" value="{{ old('date') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        

        <!-- Product Table -->
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Images</th>
                    <th class="text-center">Purchase Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->price }}</td>
                        <td class="text-center">
                            @if(count($product->images) > 0)
                                @foreach($product->images as $img)
                                    <img src="{{ asset($img) }}" width="50" class="me-1 mb-1 rounded">
                                @endforeach
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $product->date }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <button class="btn btn-dark btn-sm" type="button"
                                    onclick="showDetail({{ $product->id }})">Detail</button>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}" class="d-flex justify-content-center mt-4">
            @csrf
            <button type="submit" class="btn btn-warning">Logout</button>
        </form>
    </div>


    <div id="detailModal" class="modal-overlay">

        <div class="modal-box">
            <h4 class="mb-3">Product Detail</h4>

            <p><strong>Name:</strong> <span id="modalName"></span></p>
            <p><strong>Price:</strong> <span id="modalPrice"></span></p>
            <p><strong>Date:</strong> <span id="modalDate"></span></p>

            <p class="mt-2"><strong>Images:</strong></p>
            <div id="modalImages" class="d-flex flex-wrap gap-2"></div>

            <button onclick="closeDetail()" class="btn btn-danger btn-sm mt-3 w-100">
                Close
            </button>
        </div>
    </div>



    <script>
        // Image Preview for Add Product
        const imagesInput = document.getElementById('imagesInput');
        const imagePreview = document.getElementById('imagePreview');
        let selectedFiles = [];

        function renderPreview() {
            imagePreview.innerHTML = '';
            selectedFiles.forEach((file, i) => {
                const div = document.createElement('div');
                div.className = 'd-flex align-items-center mb-1';
                div.innerHTML = `<span class="text-white me-2">${file.name}</span>
                                 <button type="button" class="btn btn-sm btn-danger">Remove</button>`;
                div.querySelector('button').onclick = () => { selectedFiles.splice(i, 1); renderPreview(); };
                imagePreview.appendChild(div);
            });
        }

        imagesInput.onchange = e => {
            selectedFiles.push(...e.target.files);
            e.target.value = '';
            renderPreview();
        };

        document.querySelector('form').onsubmit = () => {
            const dt = new DataTransfer();
            selectedFiles.forEach(f => dt.items.add(f));
            imagesInput.files = dt.files;
        };


        // Detail Modal
        const products = @json($products);

        function showDetail(id) {
            const product = products.find(p => p.id === id);

            document.getElementById('modalName').innerText = product.name;
            document.getElementById('modalPrice').innerText = product.price;
            document.getElementById('modalDate').innerText = product.date;

            const imagesContainer = document.getElementById('modalImages');
            imagesContainer.innerHTML = '';

            if (product.images && product.images.length > 0) {
                product.images.forEach(img => {
                    const imgEl = document.createElement('img');
                    imgEl.src = img.startsWith('http') ? img : '{{ asset('') }}' + img;
                    imgEl.style.width = '60px';
                    imgEl.style.height = '60px';
                    imgEl.className = 'rounded';
                    imagesContainer.appendChild(imgEl);
                });
            } else {
                imagesContainer.innerHTML = '<small>No images</small>';
            }

            document.getElementById('detailModal').classList.add('active');
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.remove('active');
        }
    </script>
</body>

</html>