@extends('admin/layout')
@section('page_title','Setting Details')
@section('page_select','active')
@section('container')

<h1 class="mb10">Manage Settings</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('pages.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="privacypolicy" class="control-label mb-1">Privacy policy</label>
                                    <textarea id="privacypolicy" name="privacypolicy" class="form-control" >{{$pages->privacypolicy}}</textarea>
                                    @error('privacypolicy')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="aboutus" class="control-label mb-1">About Us</label>
                                    <textarea id="aboutus" name="aboutus" class="form-control" >{{$pages->aboutus}}</textarea>
                                    @error('aboutus')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tandc" class="control-label mb-1">Terms And Conditions</label>
                                    <textarea id="tandc" name="tandc" class="form-control" >{{$pages->terms_and_conditions}}</textarea>
                                    @error('t&c')
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
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
    $(document).ready(function () {
   CKEDITOR.replace('privacypolicy');
});

$(document).ready(function () {
   CKEDITOR.replace('aboutus');
});

$(document).ready(function () {
   CKEDITOR.replace('tandc');
});
</script>
@endsection