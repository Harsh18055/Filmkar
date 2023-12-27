@extends('admin/layout')
@section('page_title','Blog')
@section('blog_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Blogs</h1>
    <a href="{{url('admin/blog/manage_blog')}}">
        <button type="button" class="btn btn-success">
            Add Blog
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3" id="table_id">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Blog Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->title}}</td>
                        <td><img src="{{asset('assets/blog/'.$list->thumbnail)}}" style="height: 50px; width: 50px;"  alt=""> </td>
                        <td>{{$list->slug}}</td>
                        <td>
                                <a href="{{url('admin/blog/manage_blog/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>

                                @if($list->status==1)
                                    <a href="{{url('admin/blog/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/blog/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif

                                <a href="{{url('admin/blog/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                
                                 @if($list->isfeatured==1)
                                    <a href="{{url('admin/blog/isfeatured/0')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Un featured</button></a>
                                 @elseif($list->isfeatured==0)
                                    <a href="{{url('admin/blog/isfeatured/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Is featured</button></a>
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
