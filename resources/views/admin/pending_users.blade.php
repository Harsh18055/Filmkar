@extends('admin/layout')
@section('page_title','Pending Users')
@section('user_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendding_users as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->firstname}}</td>
                            <td>{{$list->lastname}}</td>
                            <td>{{$list->email}}</td>
                            <td>{{$list->phonenumber}}</td>
                            <td>
                            <a href="{{url('admin/users/details/')}}/{{$list->id}}"><button type="button" class="btn btn-primary">View Profile</button></a>

                                @if($list->status==1)
                                    <a href="{{url('admin/users/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->status==0 || $list->status==2)
                                    <a href="{{url('admin/users/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                @endif
                                    <!--<a href="{{url('admin/users/delete')}}/{{$list->id}}" onclick="return confirm('Are you sure you want to delete this item?');"><button type="button" class="btn btn-danger">Delete</button></a>-->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
         <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
                $('#table_id').DataTable();
            });
    </script>                
@endsection