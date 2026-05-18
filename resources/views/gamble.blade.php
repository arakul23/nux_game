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
                <div class="row">
                    <button class="btn btn-secondary" type="button">Regenerate Link</button>
                    <button class="btn btn-danger" type="button">Deactivate Link</button>
                </div>

            </article>
        @endif
        <article class="card">
            <h2>Imfeelinglucky</h2>
            <div class="row">
                <button class="btn btn-primary" type="button">Imfeelinglucky</button>
                <a href="{{ route('get_histories', [$user['id']]) }}"> <button class="btn btn-secondary" type="button">History</button></a>
            </div>

            <div class="result">
                <div class="result-item">
                    <p class="result-label">Random Number</p>
                    <p class="result-value">742</p>
                </div>
                <div class="result-item">
                    <p class="result-label">Result</p>
                    <p class="result-value"><span class="badge badge-win">Win</span></p>
                </div>
                <div class="result-item">
                    <p class="result-label">Win Amount</p>
                    <p class="result-value">371.00</p>
                </div>
            </div>
        </article>
    </section>
</main>
</body>
</html>
