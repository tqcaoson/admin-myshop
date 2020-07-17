<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
        return view('admin.slide.danhsach', ['slide' => $slide]);
    }
    public function getThem(){
    	return view('admin.slide.them');
    }
    public function getSua($id){
    	$slide = Slide::find($id);
        return view('admin.slide.sua', ['slide' => $slide]);
    }
    public function getXoa($id){
    	$slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
        $slide = Slide::find($id);
        if($request->has('Link'))
            $slide->link = $request->Link;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/sua')->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->image);
            $file->move("upload/slide", $hinh);
            $slide->image = $hinh;
        }else $slide->image = "";
        $slide->save();
        return redirect()->back()->with('thongbao', 'Sửa bài thành công');
    }
    public function postThem(Request $request){
        $slide = new Slide;
        if($request->has('Link'))
            $slide->link = $request->Link;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect()->back()->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("image/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move("image/slide", $hinh);
            $slide->image = $hinh;
        }else $slide->image = "";
        $slide->save();
        return redirect()->back()->with('thongbao', 'Thêm bài thành công');
    }
}
