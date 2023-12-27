@extends('admin/layout')
@section('page_title','Pending Organize')
@section('organize_select','active')
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending_organize as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->email}}</td>
                            <td>{{$list->type}}</td>
                            <td>{{$list->company}}</td>
                            <td>
                                <a href="{{url('admin/organize/details/')}}/{{$list->id}}"><button type="button" class="btn btn-primary">View Profile</button></a>
                                @if($list->is_approved==1)
                                    <a href="{{url('admin/organize/is_approved/0')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Disapprove</button></a>
                                @elseif($list->is_approved==0)
                                    <a href="{{url('admin/organize/is_approved/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Approve</button></a>
                                @endif
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
