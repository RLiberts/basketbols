<?php
use App\Http\Controllers\StatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');

Route::middleware('auth')->group(function () {
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');

Route::middleware('auth')->group(function () {
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
    Route::put('/admin/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('admin.users.block');
});

Route::middleware('auth')->group(function () {
    Route::post('/games/{game}/stats', [StatController::class, 'store'])->name('stats.store');
    Route::get('/stats/{stat}/edit', [StatController::class, 'edit'])->name('stats.edit');
    Route::put('/stats/{stat}', [StatController::class, 'update'])->name('stats.update');
    Route::delete('/stats/{stat}', [StatController::class, 'destroy'])->name('stats.destroy');
});