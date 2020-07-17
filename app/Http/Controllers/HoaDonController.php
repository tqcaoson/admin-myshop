<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Cart; 
use Session;

class HoaDonController extends Controller
{
    public function getDanhSach(){
    	$hoadon = Bill::all();
    	return view('admin.hoadon.danhsach', ['hoadon' => $hoadon]);
    }
    public function getDanhSachChiTiet($id){
    	$hoadonchitiet = BillDetail::where('id_bill', $id)->get();
    	return view('admin.hoadon.danhsachchitiet', ['hoadonchitiet' => $hoadonchitiet]);
    }
    public function getSua($id){
        $hoadonchitiet = BillDetail::find($id);
    	return view('admin.hoadon.sua', ['hoadonchitiet' => $hoadonchitiet]);
    }
    public function getXoa($id){
        $hoadon = Bill::find($id);
        $hoadonchitiet = BillDetail::where('id_bill',$id);
        $hoadonchitiet->delete();
        $hoadon->delete();
        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){

        $bill_detail = BillDetail::find($id);
        $bill_detail->quantity = $request->quantity;
        $bill_detail->save();

        $bill = Bill::where('id', $bill_detail->id_bill)->first();
        $bill->total = ($bill_detail->price*$bill_detail->quantity); 
        $bill->save();

        return redirect()->back()->with('thongbao', 'Sửa hóa đơn thành công');
        
    }
}
