@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa Đơn
                            <small>Danh Sách</small>
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
                                <th>Mã Khách</th>
                                <th>Ngày Order</th>
                                <th>Tổng Tiền</th>
                                <th>Chi Tiết HĐ</th>
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($hoadon as $tl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl -> id}}</td>
                                <td>{{$tl -> id_customer}}</td>
                                <td>{{$tl -> date_order}}</td>
                                <td>{{$tl -> total}}</td>
                                <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="admin/hoadon/chitietHD/{{$tl -> id}}">Chi Tiết HĐ</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/hoadon/xoa/{{$tl -> id}}">Xóa</a></td>
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