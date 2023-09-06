<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            padding: 10px;
        }
       
        .submit input{
            width: 150px;
            color: grey;
        }
        .img-container{
            padding: 50px;
        }
        .img-container img{
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="img-container">
        <img src="{{asset('storage/products_images/'.$product->img)}}" width="100" height="100" alt="img">
    </div>
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <Table >
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input type="text" placeholder="Enter products Name" name="name" value="{{$product->name}}">
                </td>
            </tr>
            <tr>
                <td>
                    description
                </td>
                <td>
                   <textarea name="description" id="" placeholder="Enter desc" cols="30" rows="10" >
                    {{$product->description}}
                   </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    price
                </td>
                <td>
                    <input type="number" step="0.01" min="0" placeholder="Enter products price" name="price" value="{{$product->price}}">
                </td>
            </tr>
            <tr>
                <td>
                    Category
                </td>
                <td>
                   <select name="category" >
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id==$product->category_id?'selected':''}}>{{$category->name}}</option>
                    @endforeach
                   </select>
                </td>
                <td>
                    <a href="{{route('categories.create')}}">Add categorie</a>
                </td>
            </tr>
            <tr>
                <td>
                    image
                </td>
                <td>
                    <input type="file" name="img">
                </td>
            </tr>
            
        </Table>
       <div class="submit">
       <input class="btn" type="submit" value="Save">
       </div>
    </form>
</body>
</html>