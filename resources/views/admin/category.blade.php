@extends('admin/layout')
@section('page_title','Category')
@section('category_select','active')
@section('container')
    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> 
    @endif                     
    <h1 class="mb10">Category</h1>
    <a href="{{url('admin/category/manage_category')}}">
        <button type="button" class="btn btn-success">
            Add Category
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
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            @if($is_attr == 'yes')
                            <th>Is Attr</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->category_name}}</td>
                            <td>{{$list->category_slug}}</td>
                            @if($is_attr == 'yes')
                            <td>
                                @if($list->is_attr==1)
                                    <a href="{{url('admin/category/is_attr/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->is_attr==0)
                                    <a href="{{url('admin/category/is_attr/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif
                            </td>
                            @endif
                            <td>
                                @if($jobs != '')
                                    @foreach($jobs as $onejob)
                                        @if($onejob->job_role_id == $list->id)
                                        <a href="javascript:void();" id="btn_sendnoti" data-catid="{{$list->id}}"><button type="button" class="btn btn-info"><span class="badge badge-light">{{$count}}</span> New Jobs</button></a>
                                        @endif
                                    @endforeach
                                @endif
                                <a href="{{url('admin/category/manage_category/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Edit</button></a>

                                @if($list->status==1)
                                    <a href="{{url('admin/category/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                                 @elseif($list->status==0)
                                    <a href="{{url('admin/category/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Deactive</button></a>
                                @endif

                                <a href="{{url('admin/category/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
  $("#btn_sendnoti").click(function(){
    // let $jobid = $(this).data('jobid');
    let $catid = $(this).data('catid');
    let timerInterval
              Swal.fire({
              title: 'Wait...',
              // html: 'I will close in <b></b> milliseconds.',
              //   timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                  Swal.showLoading()
                  const b = Swal.getHtmlContainer().querySelector('b')
                  timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
                  },)
              },
              })
//   var formData = new FormData($('#frm_noti')[0]);
var baseUrl = location.protocol + '//' + location.host;
              $.ajax({
                  url: baseUrl+'/admin/jobs/sendnoti/'+$catid,
                  type: 'get',
                  async: true,
                  success: function (data) {
                      if($.isNumeric(data)){
                          window.scrollTo(0,0);
                          willClose: () => {
                              clearInterval(timerInterval)
                          }
                          
                          Swal.fire(
                                'Good job!',
                                'Notification Sent successful.',
                                'success',

                              ).then(function() {
                                window.location.reload(1);
                                  },1000);
                      }else{
                          window.scrollTo(0,0);
                          
                          $("#alert").html('<div class="alert alert-danger">'+data+'</div>');
                      }
                  },
                  cache: false,
                  contentType: false,
                  processData: false
              });
            });
  </script>  
   <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
                $('#table_id').DataTable();
            });
    </script>
@endsection