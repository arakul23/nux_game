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
    <h1 class="title">Page A</h1>
    <p class="subtitle">Unique link management and lucky game screen</p>

    <section class="grid">
        @if(session('url'))
            <article class="card">
                <h2>Unique Link</h2>
                <p class="link-box">{{ session('url') }}</p>
                <p class="meta">Link status: Active | Expires in: 7 days</p>

            </article>
        @endif
        <article class="card">
            <h2>Imfeelinglucky</h2>
            <div class="row">
                <a href="{{ route('calculate_gamble', [$user['id']]) }}"> <button class="btn btn-secondary" type="button">Imfeelinglucky</button></a>
                <a href="{{ route('get_histories', [$user['id']]) }}">
                    <button class="btn btn-secondary" type="button">History</button>
                </a>
                <a href="{{ route('generate_link', [$user['id']]) }}"> <button class="btn btn-secondary" type="button">Generate new link</button></a>
                <a href="{{ route('unsigned_link', [$user['id']]) }}"> <button class="btn btn-secondary" type="button">Unsigned link</button></a>
            </div>

            @if(session()->has('result'))
                @php($result = session('result'))
                <div class="result">
                    <div class="result-item">
                        <p class="result-label">Random Number</p>
                        <p class="result-value">{{$result['number']}}</p>
                    </div>
                    <div class="result-item">
                        <p class="result-label">Result</p>
                        <p class="result-value"><span class="badge {{$result['status'] === 'win' ? 'badge-win' : 'badge-lose'}}">{{$result['status']}}</span></p>
                    </div>
                    <div class="result-item">
                        <p class="result-label">Win Amount</p>
                        <p class="result-value">{{$result['amount']}}</p>
                    </div>
                </div>
            @endif
        </article>
    </section>
</main>
</body>
</html>
