@include('layouts.layout')

<div class="card-body">
    <div class="card-body">
        <form action="{{ route('create.income') }}" method="post">
            @csrf
            <label for='amount'>ユーザー名</label>
            <input type='text' class='form-control' name='amount' value="" />
            <label for='date' class='mt-2'>メールアドレス</label>
            <input type='date' class='form-control' name='date' id='date' value="" />
            <label for='type' class='mt-2'>住所</label>
            <input type="">
            <label for='comment' class='mt-2'>メモ</label>
            <textarea class='form-control' name='comment'></textarea>
            <div class='row justify-content-center'>
                <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
            </div>
        </form>
    </div>
</div>
