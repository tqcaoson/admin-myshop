@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>tên</th>
                                <th>Loại</th>
                                <th>Mô Tả</th>
                                <th>Giá Gốc</th>
                                <th>Ảnh</th>
                                <th>Màu</th>
                                <th>Chất liệu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($sanpham as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>{{$tt->name}}</td>
                                <td>{{$tt->product_type->name}}</td>
                                <td>{{$tt->description}}</td>
                                <td>{{$tt->price}}</td>
                                <td>
                                    <img src="upload/image/product/{{$tt->anh->link}}" width="100px">
                                </td>
                                <td>{{$tt->color}}</td>
                                <td>{{$tt->material}}</td>
                                
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/xoa/{{$tt->id}}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/sua/{{$tt->id}}">Sửa</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection