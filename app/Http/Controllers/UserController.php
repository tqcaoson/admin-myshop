<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bill;
use App\BillDetail;
use Auth;
use Hash;

class UserController extends Controller
{
    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function getdangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap'); 
    }
    public function postdangnhapAdmin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|max:30|min:6',
            ],
            [
                'email.required'=>'Không được để trống email',
                'email.unique'=>'Vui lòng nhập đúng email',
                'password.required'=>'Không được để trống password',
                'password.max'=>'Password từ 6-30 ký tự',
                'password.min'=>'Password từ 6-30 ký tự',
            ]);
        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect('admin/user/danhsach');
        }return redirect()->back()->with('thongbao', 'Tài khoản mật khẩu không chính xác');
    }
    public function getDanhSach(){
    	$user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }
    public function getThem(){ 
        return view('admin.user.them');
    }
    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua', ['user' => $user]);
    }
    public function getXoa($id){
        $user = User::find($id);
        $bill = Bill::where('id_customer', $id)->get();
        //dd($bill);
        foreach ($bill as $bi) {
            $billde = BillDetail::where('id_bill', $bi->id);
            //dd($billde);
            $billde->delete();
        } 
        $bill = Bill::where('id_customer', $id);
        $bill->delete();
        $user->delete();
        return redirect()->back()->with('thongbao', 'Bạn đã xóa thành công người dùng');
    }
    public function postSua(Request $request, $id){
        
    	$this -> validate($request,
            [
                'name' => 'required|min:6|max:30',
            ],
            [
                'name.required' => 'Bạn chưa nhập tài khoản',
                'name.min' => 'Tài khoản từ 6 đến 30 kí tự',
                'name.max' => 'Tài khoản từ 6 đến 30 kí tự',
            ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->changepw == 'on'){
            $this -> validate($request,
            [
                'password' => 'required|min:6|max:30',
                'password2' => 'required|same:password',
            ],
            [
                'password.required' => 'Bạn chưa nhập password',
                'password.max' => 'password từ 6 đến 30 kí tự',
                'password.min' => 'password từ 6 đến 30 kí tự',
                'password2.required' => 'Bạn chưa nhập lại password',
                'password2.same' => 'password nhập lại không khớp',
            ]);
            $user->password = md5($request->password);
        }
        $user->save();
        return redirect()->back()->with('thongbao', 'Sửa user thành công');
    }
    public function postThem(Request $request){
    	$this -> validate($request,
            [
                'name' => 'required|min:6|max:30',
                'password' => 'required|min:6|max:30',
                'email' => 'required|email|unique:users,email',
                'password2' => 'required|same:password',
            ],
            [
                'name.required' => 'Bạn chưa nhập tài khoản',
                'password.required' => 'Bạn chưa nhập password',
                'name.min' => 'Tài khoản từ 6 đến 30 kí tự',
                'name.max' => 'Tài khoản từ 6 đến 30 kí tự',
                'password.max' => 'password từ 6 đến 30 kí tự',
                'password.min' => 'password từ 6 đến 30 kí tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'email đã tồn tại',
                'password2.required' => 'Bạn chưa nhập lại password',
                'password2.same' => 'password nhập lại không khớp',
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = md5($request->password);
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('thongbao', 'Thêm user thành công');
    }
}
