@extends('admin/layout')
@section('page_title','Manage Blog')
@section('blog_select','active')
@section('container')
<div class="overview-wrap">
    <h2 class="title-1">Manage Category</h2>
    <a href="{{url('admin/blog')}}" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Back</a>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Select Banner</div>
                    <div class="card-body">
                        <form action="{{route('manage_banner_process')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$id}}"/>
                            @csrf
                            <div class="form-group">
                                <label for="value" class="control-label mb-1">{{$key}}</label>
                                <input id="value" name="value" type="file" class="form-control" 
                                value="{{$value}}">
                                @error('value')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            @if($value != null)
                        <img src="{{asset('assets/banner/'.$value)}}" style="height: 250px; width: 500px;"  alt="">
                            @endif
                              <div class="form-group">
                                <label for="link" class="control-label mb-1">Link</label>
                                <input id="link" name="link" type="url" class="form-control" 
                                value="{{$link}}">
                                @error('link')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection