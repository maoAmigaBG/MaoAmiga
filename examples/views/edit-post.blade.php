<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>edit-post</h1>
    <form action="/edit-post/{{$post->id}}" method="post">
    @csrf
    @method("PUT")
    <input type="text" id="title" name="title" value="{{$post->title}}">
    <textarea name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
    <button type="submit">Save</button>
    </form>
</body>
</html>