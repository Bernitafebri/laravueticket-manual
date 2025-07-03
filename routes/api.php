<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\API\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/test-me", function () {
    return 'Hello from Laravel!';
});



// AUTH
Route::post('/login', LoginController::class)->name('login');

Route::middleware(['auth:api'])->group(function () {

    // Ticket
    Route::prefix('ticket')->as('ticket.')->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/all', [TicketController::class, 'all'])->name('all');
            Route::post('/start/{id}', [TicketController::class, 'updateStartHoldClosed'])->name('start');
            Route::post('/hold/{id}', [TicketController::class, 'updateStartHoldClosed'])->name('hold');
            Route::post('/review/{id}', [TicketController::class, 'updateReview'])->name('review');
        });
        Route::post('/closed/{id}', [TicketController::class, 'updateStartHoldClosed'])->name('closed');

        Route::get('/{id}', [TicketController::class, 'show'])->name('show');
        Route::post('/store', [TicketController::class, 'store'])->name('store');
    });


    Route::post('/logout', LogoutController::class)->name('logout');
});
