<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Address;
use App\Post;
use App\Role;
use App\Staff;
use App\Product;
use App\Video;
use App\Tag;

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


Route::get('/create', function(){

    $user = User::findOrFail(1);

    $post = new Post(['title'=> 'my first post with edwin diaz', 'content'=>'i love laravel with edwin']);

    $user->posts()->save($post);

});

Route::get("/read-posts", function(){

    $user = User::findOrFail(1);
    
    forEach($user->posts as $post){
            echo $post;
    };

});


Route::get('/updated', function(){

    $user = User::findOrFail(1);
    $user->posts()->whereId('id', 1)->update(['title'=>'tet', 'content'=>'this is awesome']);

});


Route::get('/delete', function(){

    $user = User::findOrFail(1);
    echo $user->posts()->delete();

});


Route::get('/create-rol-user', function(){

    $user = User::find(1);
    $role = new Role(['name'=>'Administrator']);
    $user->roles()->save($role);

});

Route::get('/read', function(){

    $user = user::findOrFail(1);
    
    forEach($user->roles as $role) {

        dd($role->name);

    }   

});


Route::get('/update', function(){

    $user = User::findOrFail(1);

    if ($user->has('roles')){
        foreach($user->roles as $role) {
            if($role->name == "Administrator") {
                $role->name = 'Admin';
                $role->save();
            }
        }
    }

});


Route::get('/delete', function(){

    $user = User::findOrFail(1);

    foreach($user->roles as $role) {
        $role->whereId(1)->delete();
    }

});

Route::get('/attach', function(){

    $user = User::findOrFail(1);
    $user->roles()->detach(3);

});


Route::get('/sync', function(){

    $user = User::findOrFail(1);
    $user->roles()->sync([1,2]);

});


Route::get('/createStaff', function(){

    $staff = Staff::create(['name'=>'Jack Meng']);
    echo $staff;

});

Route::get('/createProduct', function(){

    $product = Product::create(['name'=>'flask']);
    echo $product;

});

Route::get('/createStaffPhoto', function(){

    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'example.jpg']);

});


Route::get('/read', function(){

    $staff = Staff::findOrFail(1);
    
    foreach($staff->photos as $photo) {
        return $photo;
    }

});


Route::get('/update', function(){

    $staff = Staff::findOrFail(1);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = "updated example";
    $photo->save();

});

Route::get('/delete', function(){

    $staff = Staff::findOrFail(1);
    $staff->photos()->delete();    

});

Route::get('/assign', function(){

    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(1);

    $staff->photos()->save($photo);

});


Route::get('/un-assign', function(){

    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(1);

    $staff->photos()->whereId(4)->update(['imageable_id'=>'', 'imageable_type'=>'']);

});

Route::get('/createTag', function(){

    Tag::create(['name'=>'fun']);
    Tag::create(['name'=>'psychedelic']);

});


Route::get('/create2', function(){

    $post = Post::create(['name'=>'My first post']);
    $tag = Tag::find(1);
    $post->tags()->save($tag);

    $video = Video::create(['name'=>'video.mov']);
    $tag2 = Tag::find(2);
    $video->tags()->save($tag2);

});


Route::get('/read-poly', function(){

    $post = Post::findOrFail(1);

    foreach($post->tags as $tag){
        echo $tag;
    };

});


Route::get('/update-poly', function(){

    // $post = Post::findOrFail(1);

    // foreach($post->tags as $tag){
        
    //     return $tag->whereName('fun')->update(['name'=>'even more psychedelic']);

    // };

    $post = Post::findOrFail(1);
    $tag = Tag::find(1);

    // $post->tags()->atach($tag);
    // $post->tags()->detach($tag);
    $post->tags()->sync([2]);

});


Route::get('/deletePoly', function(){

    $post = Post::find(1);

    foreach($post->tags as $tag){

        $tag->whereId(2)->delete();

    }

});
