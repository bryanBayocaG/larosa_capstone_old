<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print QR code</title>
    <style>
        .btn-group .button {
            border: 1px solid #bd9a62;
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
    </style>
</head>

<body>
    <center><img style="width: 40%"src="assets/picture/Larosa.jpg" alt=""></center>

    <center>
        <h4>{{ $setItem->name }}</h4>
    </center>
    <h4>Main Set QR Code</h4>
    <center>
        <div style="margin-top: 1rem">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(140)->generate($setItem->set_code)) !!} ">
        </div>
    </center>
    <h4>Included QR Code in the set</h4>
    <div class="btn-group">
        @foreach ($includes as $key => $incluItem)
            <div class="button" style="margin-top: 1rem">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::size(130)->generate($incluItem->item->item_code)) !!} ">
                <p style="background-color: #bd9a62">{{ $incluItem->item->item_code }}center </p>
            </div>
            @if (($key + 1) % 4 == 0)
                <div style="clear: both;"></div>
            @endif
        @endforeach
    </div>

</body>

</html>
