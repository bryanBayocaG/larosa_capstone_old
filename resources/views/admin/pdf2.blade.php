<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print QR code</title>
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
    <center>
        <h4>{{ $setItem->name }} - SET</h4>
    </center>
    <h4>Main Set QR Code</h4>
    <div class="btn-group">
        <div class="button" style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(130)->generate($setItem->link)) !!} ">
            {{-- <p style="background-color: #bd9a62">{{ $incluItem->item->item_code }} </p> --}}
        </div>
        <div class="button" style="margin-top: 1rem">
            <img style="width: 53%"src="assets/picture/Larosa.jpg" alt="">
            <p style="color: black">{{ $setItem->name }} - {{ $setItem->set_code }}</p>
        </div>
    </div>

    {{-- <div style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(140)->generate($setItem->link)) !!} ">
        </div> --}}

    <h4>Included QR Code in the set</h4>
    @foreach ($includes as $incluItem)
        <div class="btn-group">
            <div class="button" style="margin-top: 1rem">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::size(130)->generate($incluItem->item->link)) !!} ">
                {{-- <p style="background-color: #bd9a62">{{ $incluItem->item->item_code }} </p> --}}
            </div>
            <div class="button" style="margin-top: 1rem">
                <img style="width: 53%"src="assets/picture/Larosa.jpg" alt="">
                <p style="color: black">{{ $incluItem->item->name }} - {{ $incluItem->item->item_code }}</p>
            </div>
        </div>
    @endforeach



</body>

</html>
