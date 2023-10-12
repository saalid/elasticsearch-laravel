<?php

use Illuminate\Support\Facades\Route;

use App\Services\Index\Instagram;
use App\Services\Index\News;
use App\Services\Index\Twitter;

use App\Services\Alarm\Alarm;
use Illuminate\Support\Carbon;
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


Route::get('/create/instagram', function () {
    $fields = [
        'name'=> "amirreza",
        'username'=> "ashdjashdkdas",
        'title'=> "asdja ahsjdhka asjhkdhjka",
        'gallery_pic'=>  "http://instagram.com/test.jpeg",
        'gallery_video'=>  "http://instagram.com/test.mp4",
        'text'=> "sdaskdaksh ahsdhkashkk",
        'avatar'=> "ashkdjhash haskda",
        'created_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,
        'updated_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,

    ];
    Instagram::insert($fields);
});
Route::get('/create/twitter', function () {
    $fields = [
        'name'=> "Hasan",
        'count_twitt'=> "123",
        'gallery_pic'=>  "http://twitter.com/test.jpeg",
        'twitt'=> "Twitt test",
        'avatar'=> "amirrzeaAvatar",
        'created_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,
        'updated_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,

    ];
    Twitter::insert($fields);
});
Route::get('/create/news', function () {
    $fields = [
        'title'=> "Hamle be ghaze",
        'source'=>  "Khabargozari mashregh",
        'data'=>  "1200 jangande",
        'link'=> "http://mashregh.ir",
        'avatar'=> "mashreghAvatar",
        'created_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,
        'updated_at' => Carbon::parse(now()->format("Y-m-d H:i:s"))->timestamp,
    ];
    News::insert($fields);
});

