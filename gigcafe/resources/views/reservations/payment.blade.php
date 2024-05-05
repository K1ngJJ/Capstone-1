<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ url('charge') }}" method="post">
    @csrf
    <input type="text" name="amount" value="10.00" />
    <input type="submit" name="submit" value="Pay Now" />
</form>
</body>
</html>