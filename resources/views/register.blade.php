<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/register" method="POST">
        <input type="text" name="name" id="name" placeholder="enter name" required>
        <input type="email" name="email" id="email" placeholder="enter email" required>
        <input type="password" name="password" id="password" placeholder="Enter ur pass" required>
        <li>
            @if(isset($roles) && count($roles) > 0)
                @foreach ($roles as $role)
                    <li>{{$role->role}}</li>
                @endforeach
            @endif
        </li>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
