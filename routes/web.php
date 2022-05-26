<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/users', function () {
    $users = \App\Models\User::get();

    return $users;
});

Route::get('c', function () {
    return config('database.connections.mysql');
});
Route::get('try', function () {

    $username = env('DB_USERNAME', 'forge');
    $password = env('DB_PASSWORD', '');
    $dbName = env('DB_DATABASE', 'forge');
    $connectionName = env('DB_SOCKET', '');
    $socketDir = getenv('DB_SOCKET_DIR') ?: '/cloudsql';

    $dsn = sprintf(
        'mysql:dbname=%s;unix_socket=%s/%s',
        $dbName,
        $socketDir,
        $connectionName
    );

    echo $dsn;

// Connect to the database.
    $conn = new PDO($dsn, $username, $password, []);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
