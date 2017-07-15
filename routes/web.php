<?php

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

/*
 ________________________________________________________________________________________ 
|																						|
|______________________________________INFORMASI________________________________________|
|																						|
|	Sebelum menambahkan data route, pastikan menuliskan alamat route pada 				|
|	AuthServiceProvider agar halaman bisa terbaca oleh sistem 							|
|_______________________________________________________________________________________|
*/

Auth::routes();

Route::get('/','Auth\LoginController@index');
// Route::get('/formlogin','Auth\LoginController@index');

Route::get('/login',function(){
	return redirect('/');
});

Route::get('/','Auth\LoginController@index');




Route::get('/home', ['uses'=>'HomeController@index','as'=>'home','roles'=>['admin']]);
Route::get('/home/profile', 'HomeController@profile');
Route::get('/home/ganti_password', 'HomeController@ganti_password');
Route::get('/home/tampilan', 'HomeController@setting_tampilan');
Route::post('/upload_photo', 'Administrator\C_Pengguna@upload_photo');
Route::post('/edit_tampilan', 'Administrator\C_Pengguna@edit_tampilan');
Route::post('/ubah_password', 'Administrator\C_Pengguna@ubah_password');
Route::post('/ubah_profile', 'Administrator\C_Pengguna@ubah_profile');


// -------------------------  KEPEGAWAIAN ---------------------------------//
Route::get('/home/daftar_pengguna', ['uses'=>'HomeController@daftar_pengguna','as'=>'daftar_pengguna','roles'=>['admin']]);
Route::get('/home/tambah_pengguna', ['uses'=>'HomeController@tambah_pengguna','as'=>'tambah_pengguna','roles'=>['admin']]);
Route::get('/home/edit_pengguna', ['uses'=>'HomeController@edit_pengguna','as'=>'edit_pengguna','roles'=>['admin']]);
// Route::post('/add_pengguna','Administrator\C_Pengguna@add');
Route::post('/add_pengguna','Administrator\C_Pengguna@register');
Route::post('/edit_privilege',['uses'=>'Administrator\C_Pengguna@edit_privilege','as'=>'edit_privilege','roles'=>['admin']]);
Route::post('/update_pengguna','Administrator\C_Pengguna@update');
Route::post('/delete_pengguna','Administrator\C_Pengguna@delete');
// -------------------------  KEPEGAWAIAN ---------------------------------//


// -------------------------  Fasilitas ---------------------------------//
Route::get('/home/daftar_fasilitas', ['uses'=>'HomeController@daftar_fasilitas','as'=>'daftar_fasilitas','roles'=>['admin']]);
Route::post('/home/daftar_fasilitas', 'HomeController@daftar_fasilitas');
Route::post('/get_fasilitas','Administrator\C_Fasilitas@ajax_get_fasilitas_by_id');
Route::post('/add_fasilitas','Administrator\C_Fasilitas@add');
Route::post('/update_fasilitas','Administrator\C_Fasilitas@update');
Route::post('/delete_fasilitas','Administrator\C_Fasilitas@delete');
//--------------------------- Fasilitas ---------------------------------//


//--------------------------- Kelas ---------------------------------//
Route::get('/home/daftar_kelas', ['uses'=>'HomeController@daftar_kelas','as'=>'daftar_kelas','roles'=>['admin']]);
Route::post('/home/daftar_kelas', 'HomeController@daftar_kelas');
Route::get('/home/tambah_kelas', ['uses'=>'HomeController@tambah_kelas','as'=>'tambah_kelas','roles'=>['admin']]);
Route::get('/home/edit_kelas/{id_kelas}', ['uses'=>'HomeController@edit_kelas','as'=>'edit_kelas','roles'=>['admin']]);
Route::post('/home/add_kelas', 'Administrator\C_Kelas@add');
Route::post('/home/edit_kelas/{id_kelas}', 'Administrator\C_Kelas@update');
Route::post('/add_kamar','Administrator\C_Kamar@add');
//--------------------------- Kelas ---------------------------------//


//--------------------------- Promo ---------------------------------//
Route::get('/home/daftar_promo', ['uses'=>'HomeController@daftar_promo','as'=>'daftar_promo','roles'=>['admin']]);
Route::post('/home/daftar_promo', 'HomeController@daftar_promo');
Route::post('/home/tambah_promo', 'Administrator\C_promo@add');
Route::post('/delete_promo','Administrator\C_promo@delete');
//--------------------------- Promo ---------------------------------//


//--------------------------- Pemesanan ---------------------------------//
Route::get('/home/pesan_kamar', ['uses'=>'HomeController@pesan_kamar','as'=>'pesan_kamar','roles'=>['admin']]);
Route::get('/home/pesan_kamar/search', ['uses'=>'HomeController@search_kamar','as'=>'search_kamar','roles'=>['admin']]);
Route::get('/home/pesan_kamar/booking', ['uses'=>'HomeController@booking','as'=>'booking','roles'=>['admin']]);
Route::post('/pesan_step1/{id_kelas}/{nama}/{data_reservasi}', 'Administrator\C_Order@step1');
Route::post('/add_order', 'Administrator\C_Order@add');
Route::post('/ajax_check_promo','Administrator\C_Order@ajax_generate_promo');

//--------------------------- Pemesanan ---------------------------------//


//--------------------------- Keuangan ---------------------------------//
Route::get('/home/pemasukan',function(){return redirect('/home/pemasukan/all');});
Route::get('/home/pemasukan/{parameter}', ['uses'=>'HomeController@pemasukan','as'=>'pemasukan','roles'=>['admin']]);
Route::get('/home/pengeluaran', 'HomeController@pengeluaran');
Route::get('/home/neraca', 'HomeController@neraca');
//--------------------------- Keuangan ---------------------------------//



Route::get('/home/tes1', 'HomeController@tes1');
Route::get('/home/tes2', 'HomeController@tes2');
Route::get('/home/tes3', 'HomeController@tes3');

Route::get('/tes','HomeController@tes');

Route::post('/do_login','Auth\LoginController@login');

Route::get('/formregister',function(){
	    return view('auth/register');
});
Route::get('home/logout',function(){
    Auth::logout();
    return redirect('/');
});
