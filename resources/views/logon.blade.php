<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!--só construi o html para testar backend-->
    <h1>Logon</h1>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{route("auth.logon")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old("email") }}">
        </div>
        <div>
            <label for="name">name</label>
            <input type="text" name="name" id="name" value="{{ old("name") }}">
        </div>
        <div>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" value="{{ old("password") }}">
        </div>
        <div>
            <label for="data_nasc">Data de Nascimento</label>
            <input type="date" name="data_nasc" id="data_nasc" value="{{ old("data_nasc") }}">
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" value="{{ old("foto") }}">
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>