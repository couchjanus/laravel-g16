<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Me A Mail</title>
</head>
<body>
    <h1>You Got Email</h1>
    <p>{{ $event }}</p>
    <p><img src="{{ $message->embed(public_path() . '/images/cat3.jpg') }}" alt="Reevaal Cat" width="200px;"></p>
</body>
</html>