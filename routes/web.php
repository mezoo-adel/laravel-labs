<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Auth::routes();

Route::resource('', HomeController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('news', NewsController::class);
Route::get('restore', [NewsController::class, 'restore'])->name("restore");

Route::get('auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('logGitHub');

Route::get('auth/callback', function () {

    $githubUser = Socialite::driver('github')->user();
    //  dd($githubUser->email);
  // $user = User::updateOrCreate([
    //     'github_id' => $githubUser->id,
    // ], [
    //     'name' => $githubUser->name,
    //     'email' => $githubUser->email,
    //     'github_token' => $githubUser->token,
    //     'github_refresh_token' => $githubUser->refreshToken,
    // ]);
    dump($githubUser);
    $user = User::where("email", $githubUser->email)->get();
    dd($user);

    if (!$user->first()->email) {
        # code...
        $user = User::create([
            'github_id' => $githubUser->id,
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,

        ]);
        // dump($user);
    }
//$user returns a Collection of App\Model\Users
    Auth::login($user[0]);
    return redirect('/home');
});
