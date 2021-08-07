<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> Test Page </h1>
    <a href="/about">visit the about page</a>

    <?php
    // -> get returns a collection of Model
    // -> first returns just a single Model not within a collection

    use App\Models\Blog;

    $data = Blog::where('id',1)
    ->first();
    dd($data);
    ?>
</body>
</html>


