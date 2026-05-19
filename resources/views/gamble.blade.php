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
        @if(session('link'))
            <article class="card">
                <h2>Unique Link</h2>
                <p class="link-box">{{ session('link') }}</p>
                <p class="meta">Link status: Active | Expires in: 7 days</p>

            </article>
        @endif
        <article class="card">
            <h2>Imfeelinglucky</h2>
            <div class="row">
                <form method="POST" action="{{ $actions['play'] }}">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Imfeelinglucky</button>
                </form>
                <a class="btn btn-secondary" href="{{ $actions['history'] }}">History</a>
                <form method="POST" action="{{ $actions['generate'] }}">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Generate new link</button>
                </form>
                <form method="POST" action="{{ $actions['revoke'] }}">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Unsigned link</button>
                </form>
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
