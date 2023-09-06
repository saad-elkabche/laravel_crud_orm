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
        .submit{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .submit input{
            width: 150px;
            color: grey;
        }
      
    </style>
</head>
<body>
    
    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <Table >
            <tr>
                <td>
                    Name
                </td>
                <td>
                    <input type="text" placeholder="Enter products Name" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    description
                </td>
                <td>
                   <textarea name="description" id="" placeholder="Enter desc" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    price
                </td>
                <td>
                    <input type="number" step="0.01" min="0" placeholder="Enter products price" name="price">
                </td>
            </tr>
            <tr>
                <td>
                    Category
                </td>
                <td>
                   <select name="category" >
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
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