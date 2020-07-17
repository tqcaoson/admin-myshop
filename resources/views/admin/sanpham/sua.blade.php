@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors -> all() as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/sanpham/sua/{{$sanpham->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label>Tên Sản phẩm</label>
                                <input type="text" class="form-control" name="Ten" value="{{$sanpham->name}}"> 
                            </div>
                            <label>Loại Sản phẩm</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($loaisanpham as $tl)
                                        <option value="{{$tl->id}}">{{$tl->name}}</option>
                                    @endforeach
                                </select>
                            <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea type="text" class="ckeditor" value="{{$sanpham->description}}" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Giá Gốc</label>
                                <input type="text" class="form-control" value="{{$sanpham->price}}" name="GiaGoc"> 
                            </div>
                            <div class="form-group">
                                <label>Màu</label>
                                <input type="text" class="form-control" value="{{$sanpham->color}}" name="Mau"> 
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <p><img width="400px" src="upload/image/product/{{$sanpham->anh->link}}"></p>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Chất liệu</label>
                                <input type="text" class="form-control" value="{{$sanpham->material}}" name="ChatLieu"> 
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


@endsection

