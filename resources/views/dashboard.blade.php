<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>

<style>
    .table,
    .table thead,
    .table tbody,
    .table tr,
    .table th,
    .table td {
        background: transparent !important;
        color: aliceblue;
    }



    .input-length {
        width: 25rem;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
       
        box-shadow: 0 4px 20px rgba(255, 255, 255, 0.5);
        
        border-radius: 12px;
       
        backdrop-filter: blur(8px);
        
        width: fit-content;
        padding: 20px;
        margin: auto;
    }
</style>

<body style="background-color:rgb(4, 4, 37)">
    <div class="container mt-5">
        <h1 class="text-white">Product List</h1>

        <h3 class="text-white">Add Product</h3>

        <div class="card mb-5">
            <div class="card-body d-flex justify-content-center mt-4">
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label text-white">Name</label>
                        <input type="email" class="form-control input-length" id="exampleInputEmail1"
                            aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label  text-white">Price</label>
                        <input type="text" class="form-control input-length" id="exampleInputPassword1" name="price">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label  text-white">Image</label>
                        <input type="file" class="form-control input-length" id="exampleInputPassword1" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label text-white">Purchase Date</label>
                        <input type="date" class="form-control input-length" id="exampleInputPassword1" name="date">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


        <table class="table table-striped table-hover mt-4 ">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Puchase date</th>
                    <th scope="col" class="text-center">actions</th>

                </tr>
            </thead>
            <tbody class="bg-transparent">
                <tr>
                    <th scope="row" class="text-center"></th>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-3">
                            <a href="" class="btn btn-primary">Edit</a><a href="" class="btn btn-dark">Detail</a>
                            <form action="">
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>

            </tbody>
        </table>

        <form method="POST" action="{{ route('admin.logout') }}" class="d-flex justify-content-center">
            @csrf
            <button type="submit" class="btn btn-warning ">
                logout
            </button>
        </form>

    </div>
</body>

</html>