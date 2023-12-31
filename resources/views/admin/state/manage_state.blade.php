@extends('admin/layout')
@section('page_title','Manage State')
@section('state_select','active')
@section('container')
    <h1 class="mb10">Manage Language</h1>
    <a href="{{url('admin/state')}}">
        <button type="button" class="btn btn-success">
            Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('state.manage_state_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Language</label>
                                    <input id="name" value="{{$name}}" name="name" type="text" class="form-control" required placeholder="Enter State Name" >
                                    @error('language')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                                <input type="hidden" name="id" value="{{$id}}"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
                        
@endsection