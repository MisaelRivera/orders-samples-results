<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SamplesController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\MethodsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrdersController::class, 'create']);
        Route::get('/{id}/show', [OrdersController::class, 'show']);
        Route::post('/', [OrdersController::class, 'store']);
        Route::get('/{id}/edit', [OrdersController::class, 'edit']);
        Route::put('/', [OrdersController::class, 'update']);
        Route::delete('/', [OrdersController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/samples')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('samples.index');
        Route::get('/create/{order_id}/{samples_number}', [SamplesController::class, 'create'])->name('samples.create');
        Route::get('/{id}/show', [OrdersController::class, 'show']);
        Route::post('/', [OrdersController::class, 'store']);
        Route::get('/{id}/edit', [OrdersController::class, 'edit']);
        Route::put('/{id}', [OrdersController::class, 'update']);
        Route::delete('/{id}', [OrdersController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/parameters')->group(function () {
        Route::get('/', [ParametersController::class, 'index'])->name('parameters.index');
        Route::get('/create', [ParametersController::class, 'create']);
        Route::get('/{id}/show', [ParametersController::class, 'show'])->name('parameters.show');
        Route::post('/', [ParametersController::class, 'store']);
        Route::get('/{id}/edit', [ParametersController::class, 'edit']);
        Route::put('/{id}', [ParametersController::class, 'update']);
        Route::delete('/{id}', [ParametersController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/rules')->group(function () {
        Route::get('/', [RulesController::class, 'index'])->name('rules.index');
        Route::get('/create', [RulesController::class, 'create']);
        Route::get('/{id}/show', [RulesController::class, 'show'])->name('rules.show');
        Route::post('/', [RulesController::class, 'store']);
        Route::get('/{id}/edit', [RulesController::class, 'edit']);
        Route::put('/{id}', [RulesController::class, 'update']);
        Route::delete('/{id}', [RulesController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/units')->group(function () {
        Route::get('/', [UnitsController::class, 'index'])->name('units.index');
        Route::get('/create', [UnitsController::class, 'create']);
        Route::get('/{id}/show', [UnitsController::class, 'show'])->name('units.show');
        Route::post('/', [UnitsController::class, 'store']);
        Route::get('/{id}/edit', [UnitsController::class, 'edit']);
        Route::put('/{id}', [UnitsController::class, 'update']);
        Route::delete('/{id}', [UnitsController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/methods')->group(function () {
        Route::get('/', [MethodsController::class, 'index'])->name('methods.index');
        Route::get('/create', [MethodsController::class, 'create']);
        Route::get('/{id}/show', [MethodsController::class, 'show'])->name('methods.show');
        Route::post('/', [MethodsController::class, 'store']);
        Route::get('/{id}/edit', [MethodsController::class, 'edit']);
        Route::put('/{id}', [MethodsController::class, 'update']);
        Route::delete('/{id}', [MethodsController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/lcps')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('lcps.index');
        Route::get('/create', [OrdersController::class, 'create']);
        Route::get('/{id}/show', [OrdersController::class, 'show'])->name('lcps.show');
        Route::post('/', [OrdersController::class, 'store']);
        Route::get('/{id}/edit', [OrdersController::class, 'edit']);
        Route::put('/{id}', [OrdersController::class, 'update']);
        Route::delete('/{id}', [OrdersController::class, 'destroy']);
    });
});

require __DIR__.'/auth.php';
