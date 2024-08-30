<html>
<body style="direction: rtl;text-align: center">
<div>
    @foreach($items as $item)
        <div style="border: 1px solid gray;font-family: Tahoma; font-size: 1rem">
            <strong>{{ $item['title'] }}</strong>
            <div>{{ $item['body'] }}</div>
        </div>
        <br>
    @endforeach
</div>
</body>
</html>
