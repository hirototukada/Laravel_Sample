<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="col-md-6 m-auto">
    <div class="card mt-4">
        <div class="card-header">
            <div class='text-center'>収入</div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>日付</th>
                            <th scope='col'>金額</th>
                            <th scope='col'>カテゴリ</th>
                            <th scope='col'>コメント</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ここに支出を表示する -->
                            <tr>
                                <th scope="col">{{ $incomes['date'] }}</th>
                                <th scope="col">{{ $incomes['amount'] }}</th>
                                <th scope="col">{{ $types[0]['name'] }}</th>
                                <th scope="col">{{ $incomes['comment'] }}</th>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-around mt-3">
                <div>
                    <a href="{{ route('delete.income',['id' => $incomes['id']]) }}">
                        <button class="btn btn-danger">削除</button>
                    </a>
                </div>
                <div>
                    <a href="{{ route('edit.income',$incomes['id']) }}">
                        <button class="btn btn-secondary">編集</button>
                    </a>
                </div>
                <div>
                    <a href="{{ route('ethics.deletion.income',['id' => $incomes['id']]) }}">
                        <button class="btn btn-warning">倫理削除</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
