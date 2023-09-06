<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" enctype="multipart/form-data" action="{{route('categories.update',$category->id)}}">
        @csrf
        @method('PUT')
        <img width="80" height="80" src="{{asset('storage/categories_images/'.$category->img)}}"/>
        company name :<input type="text" name="categoryName" value="{{$category->name}}"><br><br>
        company name :<input type="file" name="img"><br><br>
        <input type="submit" value="Save"><br><br>
    </form>
</body>
</html>