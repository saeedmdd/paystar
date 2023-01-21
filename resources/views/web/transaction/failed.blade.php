<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <h1>failed</h1>

    <div>
        <p>شناسه:</p>
        <span>{{$transaction->transaction_id}}</span>
    </div>
    <form action="{{route("order.pay", $transaction->order->id)}}" method="post">
        <input type="number" name="card_number" value="{{$cardNumber?->number}}">
        <button>تلاش مجدد</button>
    </form>
    <a href="{{route("product.index")}}">بازگشت</a>
</main>
</body>
</html>
