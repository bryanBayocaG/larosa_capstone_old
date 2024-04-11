<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print QR Code</title>
    <style>
        .btn-group .button {
            color: white;
            padding: 10px 24px;
            cursor: pointer;
            float: left;
        }

        .btn-group .button:not(:last-child) {
            border-right: none;
        }

        .btn-group:after {
            content: "";
            clear: both;
            display: table;
        }

        .btn-group .button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    {{-- <center>
        <h4>{{ $singItem->name }} - SINGLE</h4>
    </center> --}}

    <div class="btn-group">
        <div class="button" style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(130)->generate($singItem->link)) !!} ">
            {{-- <p style="background-color: #bd9a62">{{ $incluItem->item->item_code }} </p> --}}
        </div>
        <div class="button" style="margin-top: 1rem">
            <img style="width: 53%"src="assets/picture/Larosa.jpg" alt="">
            <p style="color: black">{{ $singItem->name }} - {{ $singItem->item_code }}</p>
        </div>
    </div>
    {{-- 
    <center>
        <div style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate($singItem->link)) !!} ">
        </div>
    </center> --}}
</body>

</html>
