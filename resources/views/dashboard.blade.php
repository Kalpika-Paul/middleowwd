<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>

<style>
   .table, 
    .table thead ,
    .table tbody,
    .table tr,
    .table th,
    .table td {
        background: transparent !important ;
        color: aliceblue;
    }
</style>

<body style="background-color:rgb(4, 4, 37)">
    <div class="container mt-5">
        <h1 class="text-white">Product List</h1>

        <h3 class="text-white">Add Product</h3>





        <table class="table table-striped table-hover mt-4 ">
            <thead>
                <tr>
                    <th scope="col"  class="text-center">ID</th>
                    <th scope="col"  class="text-center">Name</th>
                    <th scope="col"  class="text-center">Price</th>
                    <th scope="col"  class="text-center">Image</th>
                    <th scope="col"  class="text-center">Puchase date</th>
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
                    </form>  </div>
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