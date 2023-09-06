<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="{{route('categories.store')}}">
        @csrf
        Category name :<input type="text" name="categoryName"><br><br>
        category image :<input type="file" name="img"><br><br>
        <input type="submit" value="Save"><br><br>
    </form>
</body>
</html>