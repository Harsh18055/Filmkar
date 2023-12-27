@extends('admin/layout')
@section('page_title','Slider')
@section('slider_select','active')
@section('container')

<h1 class="mb10">Slider Settings</h1>
  <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                     @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                    <div class="card">
                        <div class="card-body">
                           <form action="{{ route('slider') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="Course_type">Talent Slider</label>
                                    <input type="file" class="form-control" id="talent" name="talent">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" class="control-label mb-1">Job Slider</label>
                                    <input id="job "name="job" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"  class="control-label mb-1">Event Slider</label>
                                    <input id ="event" name="event" type="file" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label" class="control-label mb-1">Movie Slider</label>
                                    <input  id="moive" name="moive"  type="file" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label class="form-label" class="control-label mb-1">Organisation Slider</label>
                                    <input id="organisation" name="organisation" type="file" class="form-control">
                                </div>
                                <div>
                                    <button  type="submit" class="btn btn-lg btn-info btn-block">
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