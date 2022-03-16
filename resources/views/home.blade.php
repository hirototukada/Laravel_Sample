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
    <div id="app">
        @extends('layouts.layout')
        @section('content')
            <main class="py-4">
                <div class="card m-auto w-50">
                    <div class="card-header text-center">
                        <a href="{{ route('form.date.sub', $now) }}" class="ml-4 mr-4">＜＜前月</a>
                        集計：{{ $now }}
                        <a href="{{ route('form.date.add', $now) }}" class="ml-4 mr-4">次月＞＞</a>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <table class='table'>
                                <thead>
                                    <p class="text-center">
                                        今月の集計：
                                        @if ($incomeSum[0]['sum'] - $spendSum[0]['sum'] < 0)
                                            <span
                                                class="text-danger">{{ $incomeSum[0]['sum'] - $spendSum[0]['sum'] }}</span>
                                        @else
                                            <span
                                                class="text-primary">{{ $incomeSum[0]['sum'] - $spendSum[0]['sum'] }}</span>
                                        @endif

                                    </p>
                                </thead>
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="scope-col text-white">
                                            使いすぎちゃったランキング
                                            <span class="text-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                                                </svg>
                                            </span>
                                        </th>
                                        <th class="scope-col text-white">カテゴリ</th>
                                        <th class="scope-col text-white">総支出</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ここにカテゴリを表示する -->

                                    @for ($i = 0; $i < count($spendTypeSums); $i++)
                                        <tr class="bg-secondary">
                                            <th scope="col">
                                                @if ($i == 0)
                                                    <span class="text-warning">1位　まじやばぽよ</span>
                                                @elseif ($i == 1)
                                                    <span class="text-info">2位　やばすんぎ</span>
                                                @elseif ($i == 2)
                                                    <span class="text-success">3位　ちょいやばみ</span>
                                                @endif
                                            </th>
                                            <th scope="col"><span
                                                    class="text-white">{{ $spendTypeSums[$i]['name'] }}</span></th>
                                            <th scope="col"><span
                                                    class="text-white">{{ $spendTypeSums[$i]['sum'] }}</span></th>
                                        </tr>
                                    @endfor

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around mt-3">
                    <a href="">
                        <button type="button" class="btn btn-primary">+収入</button>
                    </a>
                    <a href="">
                        <button type="button" class="btn btn-secondary">-支出</button>
                    </a>
                </div>
                <div class="row justify-content-around mt-2">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class='text-center'>収入</div>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <table class='table'>
                                        <thead>
                                            <p class="text-center">
                                                収入計：
                                                @if ($incomeSum[0]['sum'] == 0)
                                                    0
                                                @else
                                                    <span class="text-primary">{{ $incomeSum[0]['sum'] }}</span>
                                                @endif
                                            </p>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th scope='col'>日付</th>
                                                <th scope='col'>金額</th>
                                                <th scope='col'>詳細</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ここに収入を表示する -->
                                            @foreach ($incomes as $income)
                                                <tr>
                                                    <th scope="col">{{ $income['date'] }}</th>
                                                    <th scope="col">{{ $income['amount'] }}</th>
                                                    <th>
                                                        <a href="{{ route('income.detail', $income['id']) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-arrow-right-circle"
                                                                viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                                            </svg>
                                                        </a>
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $incomes->links() }}
                                    <div class='row justify-content-center'>
                                        <button type='submit' class='btn btn-primary w-25 mt-3'><a class="text-white"
                                                href="{{ route('create.income') }}">新規登録</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class='text-center'>支出</div>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <table class='table'>
                                        <thead>
                                            <p class="text-center">
                                                支出計：
                                                @if ($spendSum[0]['sum'] == 0)
                                                    0
                                                @else
                                                    <span class="text-danger">{{ $spendSum[0]['sum'] }}</span>
                                                @endif
                                            </p>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <th scope='col'>日付</th>
                                                <th scope='col'>金額</th>
                                                <th scope='col'>詳細</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- ここに支出を表示する -->
                                            @foreach ($spends as $spend)
                                                <tr>
                                                    <th scope="col">{{ $spend['date'] }}</th>
                                                    <th scope="col">{{ $spend['amount'] }}</th>
                                                    <th>
                                                        <a href="{{ route('spend.detail', $spend['id']) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-arrow-right-circle"
                                                                viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd"
                                                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                                            </svg>
                                                        </a>
                                                    </th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $spends->links() }}
                                    <div class='row justify-content-center'>
                                        <button type='submit' class='btn btn-primary w-25 mt-3'><a class="text-white"
                                                href="{{ route('create.spend') }}">新規登録</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        @endsection
    </div>
</body>

</html>
