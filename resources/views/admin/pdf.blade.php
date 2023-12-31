<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <center><img style="width: 50%"src="assets/picture/Larosa.jpg" alt=""></center>

    <center>
        <h4>{{ $singItem->name }}</h4>
    </center>

    <center>
        <div style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://google.com')) !!} ">
        </div>
    </center>
</body>

</html>
