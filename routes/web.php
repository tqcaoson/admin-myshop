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

Route::group(['prefix' => 'admin'], function(){
	Route::group(['prefix' => 'user'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'UserController@getDanhSach');
		Route::get('sua/{id}', 'UserController@getSua');
		Route::post('sua/{id}', 'UserController@postSua');
		Route::get('xoa/{id}', 'UserController@getXoa');
		Route::get('them', 'UserController@getThem'); 
		Route::post('them', 'UserController@postThem');
	});
	Route::group(['prefix' => 'hoadon'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'HoaDonController@getDanhSach');
		Route::get('chitietHD/{id}', 'HoaDonController@getDanhSachChiTiet');
		Route::get('sua/{id}', 'HoaDonController@getSua');
		Route::post('sua/{id}', 'HoaDonController@postSua');
		Route::get('xoa/{id}', 'HoaDonController@getXoa');
	});
	Route::group(['prefix' => 'sanpham'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'SanPhamController@getDanhSach');
		Route::get('sua/{id}', 'SanPhamController@getSua');
		Route::post('sua/{id}', 'SanPhamController@postSua');
		Route::get('xoa/{id}', 'SanPhamController@getXoa');
		Route::get('them', 'SanPhamController@getThem');
		Route::post('them', 'SanPhamController@postThem');
	});
	Route::group(['prefix' => 'theloai'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'TheLoaiController@getDanhSach');
		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');
		Route::get('xoa/{id}', 'TheLoaiController@getXoa');
		Route::get('them', 'TheLoaiController@getThem');
		Route::post('them', 'TheLoaiController@postThem');
	});
});

Route::get('admin/login', 'UserController@getdangnhapAdmin');
Route::post('admin/login', 'UserController@postdangnhapAdmin');
Route::get('admin/logout', 'UserController@getdangxuatAdmin');

