<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <x-form-input
            name="email"
        />
        <x-form-input
            type="password"
            name="password"
        />
        <x-form-submit />
    </form>
</body>
</html>