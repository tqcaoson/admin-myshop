<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	$loaisanpham = ProductType::orderBy('id', 'DESC')->get();
    	return view('admin.theloai.danhsach', ['loaisanpham'=>$loaisanpham]);
    }
    public function getThem(){
    	$loaisanpham = ProductType::all();
    	return view('admin.theloai.them', ['loaisanpham' => $loaisanpham]);
    }
    public function getSua($id){
    	$loaisanpham = ProductType::find($id);
    	return view('admin.theloai.sua', ['loaisanpham' => $loaisanpham]);
    }
    public function getXoa($id){
    	$loaisanpham = ProductType::find($id);
    	$sanpham = Product::where('id_type',$id);
		$sanpham->delete();
		$loaisanpham->delete();
		return redirect('admin/theloai/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
    	$this -> validate($request,
            [
                'Ten' => 'required|unique:product_type,name|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.unique' => 'Tên đã tồn tại',
                'Ten.min' => 'Tên phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên phải từ 3 đến 100 ký tự',
            ]);
    	$loaisanpham = ProductType::find($id);
    	$loaisanpham->name = $request->Ten;
    	$loaisanpham->save();
    	return redirect()->back()->with('thongbao', 'Sửa thành công');
    }
    public function postThem(Request $request){
    	$this -> validate($request,
            [
                'Ten' => 'required|unique:product_type,name|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'Ten.unique' => 'Tên phải đã tồn tại',
                'Ten.min' => 'Tên phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên phải từ 3 đến 100 ký tự',
            ]);
    	$loaisanpham = new ProductType;
    	$loaisanpham->name = $request->Ten;
        $loaisanpham->image = "";
    	$loaisanpham->save();
    	return redirect()->back()->with('thongbao', 'Thêm thành công');
    }
}
