<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if ($setItem && count($setItem) > 0)
        {{-- <p>{{ $setItem[0]->name }}</p> --}}
        <h5>{{ $setItem }}</h5>
    @else
        <h1>No Match Found</h1>
    @endif
</body>

</html>
