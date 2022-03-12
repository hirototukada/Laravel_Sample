<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Auth\HelloController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MapController;

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    // homeの表示
    Route::get('/',[DisplayController::class, 'index']);

    Route::group(['middleware' => 'can:view,spending'], function() {
        // 支出の詳細
        Route::get('/spend/{spending}/detail',[DisplayController::class,'spendDetail'])->name('spend.detail');
    });

    Route::group(['middleware' => 'can:view,income'], function() {
    // 収入の詳細
    Route::get('/income/{income}/detail',[DisplayController::class,'incomeDetail'])->name('income.detail');
    });
    // 支出の新規登録
    Route::get('/create.spend',[RegistrationController::class, 'createSpendFrom'])->name('create.spend');
    Route::post('/create.spend',[RegistrationController::class, 'createSpend']);
    // 支出カテゴリの追加
    Route::get('/type.insert.spend',[RegistrationController::class,'createTypeFormSpend'])->name('type.insert.spend');
    Route::post('/type.insert.spend',[RegistrationController::class,'createTypeSpend'])->name('type.Insert.spend');
    // layoutの表示
    Route::get('/layout',[DisplayController::class, 'layoutIndex']);
    // 収入の新規登録
    Route::get('/create.income',[RegistrationController::class,'createIncomeForm'])->name('create.income');
    Route::post('/create.income',[RegistrationController::class,'createIncome']);
    // 収入カテゴリの追加
    Route::get('/type.insert',[RegistrationController::class,'createTypeForm'])->name('type.insert');
    Route::post('/type.insert',[RegistrationController::class,'createType'])->name('type.Insert');
    // 支出の編集
    Route::get('/edit.form/{id}',[RegistrationController::class,'editSpendForm'])->name('edit.spend');
    Route::post('/edit.form/{id}',[RegistrationController::class,'editSpend']);
    // 収入の編集
    Route::get('/edit.income/{id}',[RegistrationController::class,'editIncomeForm'])->name('edit.income');
    Route::post('/edit.income/{id}',[RegistrationController::class,'editIncome']);
    // 支出データの削除
    Route::get('/delete.spend/{id}',[RegistrationController::class,'deleteSpend'])->name('delete.spend');
    // 支出データの倫理削除
    Route::get('/ethics.deletion.spend/{id}',[RegistrationController::class,'ethicsDeletionSpend'])->name('ethics.deletion.spend');
    // 収入データの削除
    Route::get('/delete.income/{id}',[RegistrationController::class,'deleteIncome'])->name('delete.income');
    // 収入データの倫理削除
    Route::get('/ethics.deletion.income/{id}',[RegistrationController::class,'ethicsDeletionIncome'])->name('ethics.deletion.income');

    // 次月へのリンク
    Route::get('/form.date/{now}/add',[DisplayController::class, 'formDateAdd'])->name('form.date.add');
    // 前月へのリンク
    Route::get('/form.date/{now}/sub',[DisplayController::class, 'formDateSub'])->name('form.date.sub');
    //マップページ表示
    Route::get('/map',[MapController::class, 'map'])->name('map');
    // ユーザーページを表示
    Route::get('/map_user',[MapController::class,'map_user'])->name('map_user');
});
