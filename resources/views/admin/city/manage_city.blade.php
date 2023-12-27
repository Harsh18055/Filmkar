@extends('admin/layout')
@section('page_title','Manage City')
@section('city_select','active')
@section('container')
    <h1 class="mb10">Manage Language</h1>
    <a href="{{url('admin/city')}}">
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
                            <form action="{{route('city.manage_city_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="city" class="control-label mb-1">State</label>
                                   <select name="state_id" class="form-control">
                                       <option selected disabled>Select State</option>
                                       @foreach($states as $list)
                                       @if($state_id == $list->id)
                                       <option value="{{$list->id}}" selected>
                                        @else
                                        <option value="{{$list->id}}">
                                        @endif
                                        {{$list->name}}</option>
                                       @endforeach
                                   </select>
                                    @error('state_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city" class="control-label mb-1">Language</label>
                                    <input id="city" value="{{$city}}" name="city" type="text" class="form-control" required placeholder="Enter city Name" >
                                    @error('city')
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