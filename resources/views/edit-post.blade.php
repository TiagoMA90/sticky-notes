<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit your Sticky Note</title>
</head>
<body>
<div style="border: 2px solid black; padding: 10px; margin:2.5px; background-color:rgb(163, 157, 98)">
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method("PUT")
        <div style="margin-bottom: 10px;">
            <input style="width: 60%; padding: 5px; background: hsl(73, 80.00%, 90.20%)" type="text" name="title" value="{{$post->title}}">
</div>
        <div style="margin-bottom: 10px;">
            <textarea style="width: 60%; height: 100px; padding: 5px; background: hsl(73, 80.00%, 90.20%)" name ="body">{{$post->body}}</textarea>
        </div>
        <button type="submit" style="padding: 10px 20px; background-color:hsl(55, 71.90%, 62.40%); border: dashed 1px; cursor: pointer;">Update</button>
    </form>
</div>
</body>
</html>