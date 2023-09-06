<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img.product{
            border-radius: 38px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-family: Arial, sans-serif;
        }

        /* Style the table header */
        th {
            background-color: #f2f2f2;
        }

        /* Style table headers and cells */
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        /* Add some hover effect on table rows */
        tr:hover {
            background-color: #f5f5f5;
        }
        .price{
            color: green;
        }
        img.img-category{
            border-radius: 25px;
        }
        .btn-delete{
            width: 120px;
            background-color: #EF847B;
        }
        .btn-edit{
            width: 120px;
            background-color: #659FF2;
        }
        .btn_create{
            width: 25vh;
            height: 50px;
            border-radius: 15px;
            background-color: #659FF2;
            color: black;
        }
        .btn-container{
            display: flex;
            justify-content: center;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class="btn-container">
        <a href="{{route('products.create')}}"><button class="btn_create">Create product</button></a>
    </div>
    <Table>
        <tr>
            <th>
                image
            </th>
            <th>
                name
            </th>
            <th>
                description
            </th>
            <th>
                price
            </th>
            <th>
                Category
            </th>
            <th>
                Actions
            </th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>
                <img class="product" height="70" width="70" src="{{asset('storage/products_images/'.$product->img)}}"/>
            </td>
            <td>
                {{$product->name}}
            </td>
            <td>
                {{$product->description}}
            </td>
            <td>
                <h4 class="price">{{$product->price ." DH"}}</h4>
            </td>
            <td>
                <span>
                    <img class="img-category" width="50" height="50" src="{{asset('storage/categories_images/'.$product->category_img)}}">
                    {{"  ".$product->category_name}}
                </span>
            </td>
            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="POST" style="display: inline;">
                    @csrf
                    @method("DELETE")
                    <input class="btn-delete" type="submit" value="Delete">
                </form>
                <a href="{{route('products.edit',$product->id)}}"><button class="btn-edit">Edit</button></a>
            </td>
        </tr>
        @endforeach
    </Table>
</body>
</html>