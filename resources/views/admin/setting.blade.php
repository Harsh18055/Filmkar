@extends('admin/layout')
@section('page_title','Setting Details')
@section('user_select','active')
@section('container')

<h1 class="mb10">Manage Settings</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('setting.manage_setting_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="logo_white" class="control-label mb-1">Logo White</label>
                                    <input id="logo_white" name="logo_white" type="file" class="form-control"  placeholder="Select Logo" >
                                    @error('logo_white')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="logo_black" class="control-label mb-1">Logo Black</label>
                                    <input id="logo_black" name="logo_black" type="file" class="form-control"  placeholder="Select Logo" >
                                    @error('logo_black')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slider" class="control-label mb-1">Slider</label>
                                    <input id="slider" name="slider" type="file" class="form-control"  placeholder="Select Slider" >
                                    @error('slider')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Telent Categories</label>
                                    
                                    <select name="trending_category[]" id="multiple-select" multiple="" class="form-control">
                                    @foreach($category as $onecat)
                                    @if(in_array($onecat->id, $trending_category))
                                    <option selected value="{{$onecat->id}}">
                                    @else
                                    <option value="{{$onecat->id}}">
                                    @endif
                                    {{$onecat->category_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="control-label mb-1">facebook</label>
                                    <input id="facebook" value="{{$facebook}}" name="facebook" type="text" class="form-control" required placeholder="Enter Facebook Url" >
                                    @error('facebook')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="instagram" class="control-label mb-1">instagram</label>
                                    <input id="instagram" value="{{$instagram}}" name="instagram" type="text" class="form-control" required placeholder="Enter Instagram Url" >
                                    @error('instagram')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="linkedin" class="control-label mb-1">linkedin</label>
                                    <input id="linkedin" value="{{$linkedin}}" name="linkedin" type="text" class="form-control" required placeholder="Enter Linkdin Url" >
                                    @error('linkedin')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="twitter" class="control-label mb-1">twitter</label>
                                    <input id="twitter" value="{{$twitter}}" name="twitter" type="text" class="form-control" required placeholder="Enter Twitter Url" >
                                    @error('twitter')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="footer_text" class="control-label mb-1">Footer Text</label>
                                    <textarea id="footer_text" name="footer_text" class="form-control" required placeholder="Enter Footer Text" >{{$footer_text}}</textarea>
                                    @error('footer_text')
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
                                <input type="hidden" name="id" value=""/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>

    <h1 class="mb10">Points Settings</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('setting.manage_points')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="per_reffered" class="control-label mb-1">Reffered Points</label>
                                    <input id="per_reffered" name="per_reffered" type="number" class="form-control" value="{{$per_referred}}">
                                    @error('per_reffered')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="per_referrer" class="control-label mb-1">Referrer Points</label>
                                    <input id="per_referrer" name="per_referrer" type="number" class="form-control" value="{{$per_referrer}}">
                                    @error('per_referrer')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="per_job" class="control-label mb-1">Job Points</label>
                                    <input id="per_job" name="per_job" type="number" class="form-control" value="{{$per_job}}">
                                    @error('per_job')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="per_apply" class="control-label mb-1">Apply Points</label>
                                    <input id="per_apply" name="per_apply" type="number" class="form-control" value="{{$per_apply}}">
                                    @error('per_apply')
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>

@endsection