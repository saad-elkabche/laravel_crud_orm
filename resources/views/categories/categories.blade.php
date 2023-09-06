<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function onRowClick(id){
            var url="categories/"+id;
            window.location.href=url;
        }
    </script>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            border-spacing: 0;
            font-family: Arial, sans-serif;
           
        }
        tr.table-header{
            background-color: grey;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 50px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        img.category{
            border-radius: 40px;
        }
    </style>
</head>
<body>
   
    <div style="padding: 50px;">
        <a href="{{route('categories.create')}}">Create Category</a>
    </div>
    <table>
        <tr class="table-header">
           
            <th>
                img
            </th>
            <th>
                name
            </th>
            <th>
                actions
            </th>
        </tr>
        @foreach($categories as $category)
        <tr onclick="onRowClick('{{$category->id}}')">
            <td>
              <img class="category" width="80" height="80" src="{{asset('storage/categories_images/'.$category->img)}}" >
            </td>
            <td>
               {{$category->name}}
            </td>
            <td>
              <form action="{{route('categories.destroy',$category->id)}}" method="POST" style="display: inline;">
                @method('DELETE')
                @csrf
                <button>Delete</button>
              </form>
              <a href="{{route('categories.edit',$category->id)}}"><button>edit</button></a>
            </td>
           

        </tr>
        @endforeach

    </table>
    
   
   
   
</body>
</html>
