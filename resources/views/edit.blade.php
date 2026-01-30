<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<style>
    .input-length { width: 25rem; }
    .card {
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 4px 20px rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        backdrop-filter: blur(8px);
        width: fit-content;
        padding: 20px;
        margin: auto;
    }
    .table, .table th, .table td { color: aliceblue; background: transparent !important; }
</style>

<body style="background-color:rgb(4, 4, 37)">
    <div class="container mt-5">
        <h1 class="text-white">Edit Product</h1>

        <div class="card mb-5">
            <div class="card-body d-flex justify-content-center mt-4">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update', $product->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nameInput" class="form-label text-white">Name</label>
                        <input type="text" class="form-control input-length" id="nameInput" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="priceInput" class="form-label text-white">Price</label>
                        <input type="text" class="form-control input-length" id="priceInput" name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagesInput" class="form-label text-white">Images</label>
                        <input type="file" class="form-control input-length" id="imagesInput" name="images[]" multiple>
                        
                        {{-- Existing images --}}
                        <div id="existingImages" class="mt-2 mb-2">
                            @if($product->images && count($product->images) > 0)
                                @foreach($product->images as $img)
                                    <div class="d-inline-block position-relative me-2 mb-2">
                                        <img src="{{ asset($img) }}" width="60" class="rounded">
                                       
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    
                        <div id="imagePreview" class="mt-2"></div>

                        @error('images')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('images.*')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dateInput" class="form-label text-white">Purchase Date</label>
                        <input type="date" class="form-control input-length" id="dateInput" name="date" value="{{ old('date', $product->date) }}">
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

<script>
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
        
        imagesInput.onchange = e => { selectedFiles.push(...e.target.files); e.target.value=''; renderPreview(); };
        document.querySelector('form').onsubmit = () => { 
            const dt = new DataTransfer(); selectedFiles.forEach(f => dt.items.add(f)); imagesInput.files = dt.files;
        };
</script>
</body>
</html>
