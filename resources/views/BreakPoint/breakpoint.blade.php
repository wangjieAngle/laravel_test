<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
</head>
<body>
    {{$name}}

    <button id="btn_one">点击按钮</button>
    <script>
        $("#btn_one").on('click', function () {
            $.ajax({
                type: "GET",
                url: "{{URL('breakpoint/uploadGet')}}",
                success: function(data) {
                    console.log(data);
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Range", "bytes=1-80");
                }
            });
        })
    </script>
</body>
</html>