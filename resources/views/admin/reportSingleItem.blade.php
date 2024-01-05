<!DOCTYPE html>
<html>

<head>
    <title>hey</title>
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
</head>

<body>


    <div id="qr-reader" style="width: 60%"></div>



    {{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script> --}}

    
    {{-- <script src="asset/plugins/00qr/html5-qrcode.min.js" type="text/javascript"></script> --}}
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            try {
                decodedText = decodedText.replace(/(https?|:|\/|\.)+/g, '');
                const url = `/qrCheck/${decodedText}`;
                window.location.href = url;
            } catch (error) {
                console.error('An error occurred:', error);
            }
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

</body>

</html>
