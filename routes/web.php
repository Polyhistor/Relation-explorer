<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Address;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/inserUser', function(){

    $user = User::create(['name'=>'pouya', 'email'=>'pouya@gmail.com', 'password'=>'123']);

    return $user;

});


Route::get('/insert', function(){

    $user = User::findOrFail(1);
    $address = new Address(['name'=>'1234 Houston Avenue av NY NY 1229']);
    $user->address()->save($address);

});


Route::get('/updateAddress', function(){

    $address =  Address::whereUserId(1)->first();
    $address->name = "Updated new address";
    $address->save();

});


Route::get('/read', function(){

    $user = User::findOrFail(1);
    echo $user;

});


Route::get('/delete', function(){

    $user = User::findOrFail(1);
    $user->address()->delete();
    return 'operation complete';

});
