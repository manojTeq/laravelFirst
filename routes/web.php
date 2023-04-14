<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SongsController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

Route::get('songs/create', [
    'uses' => 'SongsController@create',
    'as' => 'song.create'
]);

Route::post('songs', [
    'uses' => 'SongsController@store',
    'as' => 'song.store'
]);


// Route::get('/send-mail', function () {
    
    //     // $data['email'] = 'kmanoj@teqmavens.com';
    //     $userMail = 'manojkumaryadav7889@gmail.com';
    
    //     dispatch(new App\Jobs\SendEmailJob($userMail));
    
    //     dd('email send successfully.');
    //     // return view('welcome');
    // });
    // Route::get('songs/create', [
    //     'uses' => 'SongsController@create',
    //     'as' => 'song.create'
    // ]);
    
    // Route::post('songs', [
    //     'uses' => 'SongsController@store',
    //     'as' => 'song.store'
    // ]);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    
    require __DIR__.'/auth.php';
    
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin'])->name('admin.dashboard');
    
    require __DIR__.'/adminauth.php';
    
    Route::get('/users',[UserController::class,'index'])->name('users.index');
    
    Route::any('/pdf',[UserController::class, 'getPdf'])->name('pdf');
    Route::get('/excel',[UserController::class, 'getExcel']);
    
    // Route::get('/pdf',[UserController::class,'getPdf'])->middleware(['auth'])->name('users.getPdf');
    // Route::any('songs',function(){
    //     dd('here');
    // });
    Route::get('/excels', function(){
        // return 'excel test';

        
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Hello World !');
        $activeWorksheet->setCellValue('B3', 'Hiiiii !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');

        // redirect output to client browser
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="myfile.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');

        // Route::get('songs/create',[
        //     'uses' => 'SongsController@create',
        //     'as' => 'song.create'
        // ]);


        
        // Route::post('songs', [
        //     'uses' => 'SongsController@store',
        //     'as' => 'song.store'
        // ]);
    });

    Route::get('/home',[UserController::class, 'index1']);

    