@extends('admin/layout')
@section('page_title','Manage Institute')
@section('institute_select','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Movie Posts Details</h4>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-institute-tab" data-toggle="tab" href="#nav-institute" role="tab" aria-controls="nav-home"
                                aria-selected="true">Movie Detail</a>
                            <a class="nav-item nav-link" id="nav-vanue-tab" data-toggle="tab" href="#nav-vanue" role="tab" aria-controls="nav-vanue"
                                aria-selected="false">Movie Vanue</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Contact</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-institute" role="tabpanel" aria-labelledby="nav-institute-tab">
                            <p><strong>Title : </strong>{{$institute_post->title}}</p>
                            <p><strong>Thumbnail : </strong><br><img src="{{asset('assets/movie/poster/'.$institute_post->poster)}}" style="height: 150px; width: 250px;"  alt=""></p>
                            <p><strong>About Movie : </strong>{!!$institute_post->about!!}</p>
                            
                        </div>
                        <div class="tab-pane fade" id="nav-vanue" role="tabpanel" aria-labelledby="nav-vanue-tab">
                            <p><strong>Location : </strong>{{$institute_post->state_id}} ({{$institute_post->city}})</p>
                            <p><strong>Address : </strong>{{$institute_post->address}}</p>
                            <p><strong>Email : </strong>{{$institute_post->email}}</p>
                            <p><strong>Phone Number : </strong>{{$institute_post->contact_no}}</p>
                           

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <p><strong>Name : </strong>{{$institute_post->user_name}}</p>
                        <p><strong>Email : </strong>{{$institute_post->user_email}}</p>
                        <p><strong>Website : </strong>{{$institute_post->user_website}}</p>
                        <p><strong>Phone no : </strong>{{$institute_post->user_number}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection