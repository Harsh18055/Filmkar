@extends('admin/layout')
@section('page_title','Manage admins')
@section('admin_select','active')
@section('container')
<div class="overview-wrap">
    <h2 class="title-1">Manage Admins</h2>
    <a href="{{url('admin/admins')}}" class="au-btn au-btn-icon au-btn--blue">
        <i class="zmdi zmdi-plus"></i>Back</a>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Select Banner</div>
                    <div class="card-body">
                        <form action="{{route('create.admins')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$id}}"/>
                            @csrf
                            <div class="form-group">
                                <label for="value" class="control-label mb-1">email</label>
                                <input id="value" name="email" type="email" class="form-control" 
                                value="{{$email}}">
                                @error('email')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label mb-1">Password</label>
                                <input id="password" name="password" type="password" class="form-control" 
                                >
                                @error('password')
                                <p class="error_message">{{$message}}</p>
                                @enderror
                            </div>
                             <div class="form-group">
                                <label for="password" class="control-label mb-1">Name</label>
                                <input id="text" name="name" type="name" class="form-control" 
                                value="{{$name}}">
                                @error('name')
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