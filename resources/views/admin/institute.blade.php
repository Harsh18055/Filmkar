@extends('admin/layout')
@section('page_title','Movie')
@section('institute_select','active')
@section('container')
@if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif              
    <h1 class="mb10">Movie Posts</h1>
   
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $list)
                        <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->user_name}}</td>
                        <td>{{$list->title}}</td>
                        @php
                        $genre_ids = json_decode($list->genre);
                        $genre_names = [];
                        foreach ($genre_ids as $genre_id) {
                            $genre_name = DB::table('genre_type')->where('id', $genre_id)->value('name');
                            if ($genre_name) {
                                $genre_names[] = $genre_name;
                            }
                        }
                        $genre_names_string = implode(', ', $genre_names);
                    @endphp
                        <td>{{$genre_names_string}}</td>
                        @php
                        $format_ids = json_decode($list->language);
                        $format_names = [];
                        foreach ($format_ids as $format_id) {
                            $format_name = DB::table('languages')->where('id', $format_id)->value('language');
                            if ($format_name) {
                                $format_names[] = $format_name;
                            }
                        }
                        $format_names_string = implode(', ', $format_names);
                    @endphp
                        <td>{{$format_names_string}}</td>
                        <td>
                                <a href="{{url('admin/moive/view_institute/')}}/{{$list->id}}"><button type="button" class="btn btn-success">View</button></a>
                                @if($list->is_approved==1)
                                    <a href="{{url('admin/moive/is_approved/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Disapproved</button></a>
                                 @elseif($list->is_approved==0)
                                    <a href="{{url('admin/moive/is_approved/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Approved</button></a>
                                @endif
                                  @if($list->isfeatured==1)
                                    <a href="{{url('admin/moive/isfeatured/0')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Un featured</button></a>
                                 @elseif($list->isfeatured==0)
                                    <a href="{{url('admin/moive/isfeatured/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Is featured</button></a>
                                @endif
                            

                                <!-- <a href="{{url('admin/blog/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a> -->
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
