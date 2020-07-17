<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Bill;

class KhachHangController extends Controller
{
    public function getDanhSach(){
    	$khachhang = Customer::all();
    	return view('admin.khachhang.danhsach', ['khachhang' => $khachhang]);
    }
    public function getSua($id){
        $khachhang = Customer::find($id);
    	return view('admin.khachhang.sua', ['khachhang' => $khachhang]);
    }
    public function getXoa($id){
        $khachhang = Customer::find($id);
        $bill = Bill::where('id_customer',$id);
        $bill->delete();
        $khachhang->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
        $khachhang = Customer::find($id);
        $this -> validate($request,
            [
                'Ten' => 'required|min:3|max:100',	
                'email' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa nhập email',
                'phone_number.required' => 'Bạn chưa nhập sdt',
                'address.required' => 'Bạn chưa nhập địa chỉ',
                'Ten.min' => 'Tên thể loại phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại phải từ 3 đến 100 ký tự',
            ]);
        $khachhang->name = $request->Ten;
        $khachhang->email = $request->email;
        $khachhang->phone_number = $request->phone_number;
        $khachhang->address = $request->address;
        $khachhang->save();
        return redirect()->back()->with('thongbao', 'Sửa thành công');
        
    }
}
