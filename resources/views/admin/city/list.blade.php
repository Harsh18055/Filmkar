@extends('admin/layout')
@section('page_title','City')
@section('city_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif        
    <a href="{{url('admin/city/manage_city')}}" style="float: right;" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>add city</a>          
    <h1 class="mb10">City</h1>
   
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>State Name</th>
                            <th>City Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                             <td>{{$list->state}}</td>
                            <td>{{$list->city}}</td>
                            <td>
                                <a href="{{url('admin/city/manage_city/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>

                                <a href="{{url('admin/city/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
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