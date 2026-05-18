<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Lucky Page</title>
</head>
<body>
<main class="page">
    <h1 class="title">History</h1>
    <section class="grid">
        <article class="card">
            <h2>History (Last 3 Results)</h2>
            <ul class="history-list">
                @foreach ($history as $key => $item)
                    <li class="history-item">
                        <span>{{ $loop->iteration }} | Number: {{$item->number}} | Result: <span class="badge {{$item->status === 'win' ? 'badge-win' : 'badge-lose'}}">{{mb_strtoupper($item->status)}}</span> | Amount: {{$item->amount}}</span>
                        <small>{{$item->created_at}}</small>
                    </li>
                @endforeach
            </ul>
        </article>
    </section>
</main>
</body>
</html>
