    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\Auth\AuthAdminController;
    use App\Http\Controllers\Admin\Tables\TableController;
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */


    Route::prefix('auth')->controller(AuthAdminController::class)->group(function () {
        Route::post('login', 'login')->name('admin.auth.login'); 
    });

    Route::post('/admin/tables/fetch', [TableController::class, 'fetch'])
        ->name('admin.tables.fetch');

