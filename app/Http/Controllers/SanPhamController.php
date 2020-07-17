<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Images;
use App\ProductType;

class SanPhamController extends Controller
{
    public function getDanhSach(){
    	$sanpham = Product::orderBy('id', 'DESC')->get();
    	$loaisanpham = ProductType::all();
    	return view('admin.sanpham.danhsach', ['sanpham' => $sanpham, 'loaisanpham'=>$loaisanpham]);
    }
    public function getThem(){
    	$loaisanpham = ProductType::all();
    	$sanpham = Product::all();
    	return view('admin.sanpham.them', ['sanpham' => $sanpham], ['loaisanpham' => $loaisanpham]);
    }
    public function getSua($id){
    	$loaisanpham = ProductType::all();
    	$sanpham = Product::find($id);
    	return view('admin.sanpham.sua', ['sanpham' => $sanpham, 'loaisanpham' => $loaisanpham]);
    }
    public function getXoa($id){
    	$sanpham = Product::find($id);
        $anh = Images::where('id_product', $id);
        $anh->delete();
		$sanpham->delete();
		return redirect('admin/sanpham/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
    	$this -> validate($request,
            [
            	'description' => 'required',
            	'GiaGoc' => 'required',
                'Ten' => 'required|unique:product,name|min:3|max:100'
            ],
            [
            	'description.required' => 'Bạn chưa nhập mô tả',
                'Ten.required' => 'Bạn chưa nhập tên bánh',
                'GiaGoc.required' => 'Bạn chưa nhập giá',
                'Ten.unique' => 'Tên đã tồn tại',
                'Ten.min' => 'Tên phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên phải từ 3 đến 100 ký tự',
            ]);
    	$sanpham = Product::find($id);
    	$sanpham->name = $request->Ten;
        $sanpham->price = $request->GiaGoc;
        $sanpham->id_type = $request->TheLoai;
        $sanpham->description = $request->description;
        $sanpham->color = $request->Mau;
        $sanpham->material = $request->ChatLieu;
        $sanpham->new = 0;
        $sanpham->save();
        $anh = Images::where('id_product', $id)->first();
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect()->back()->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/image/product/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move("upload/image/product", $hinh);
            $anh->link = $hinh;
        }
        $anh->save();
    	return redirect()->back()->with('thongbao', 'Sửa bài thành công');
    }
    public function postThem(Request $request){
    	$this -> validate($request,
            [
            	'description' => 'required',
            	'GiaGoc' => 'required',
                'Ten' => 'required|unique:product,name|min:3|max:100'
            ],
            [
            	'description.required' => 'Bạn chưa nhập mô tả',
                'Ten.required' => 'Bạn chưa nhập tên',
                'GiaGoc.required' => 'Bạn chưa nhập giá',
                'Ten.unique' => 'Tên đã tồn tại',
                'Ten.min' => 'Tên phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên phải từ 3 đến 100 ký tự',
            ]);
    	$sanpham = new Product;
    	$sanpham->name = $request->Ten;
    	$sanpham->price = $request->GiaGoc;
    	$sanpham->id_type = $request->TheLoai;
    	$sanpham->description = $request->description;
    	$sanpham->color = $request->Mau;
        $sanpham->material = $request->ChatLieu;
    	$sanpham->new = 0;
        $sanpham->save();
        $anh = new Images;
        $anh->id_product = $sanpham->id;
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$name = $file->getClientOriginalName();
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect()->back()->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
    		}
    		$hinh = str_random(4)."_".$name;
    		while(file_exists("upload/image/product/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/image/product", $hinh);
    		$anh->link = $hinh;
    	}else $anh->link = "";
        $anh->save();
    	return redirect()->back()->with('thongbao', 'Thêm bài thành công');
    }
}
