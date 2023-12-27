@extends('admin/layout')
@section('page_title','Events Job')
@section('event_select','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Events Posts Details</h4>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-event-tab" data-toggle="tab" href="#nav-event" role="tab" aria-controls="nav-home"
                                aria-selected="true">Event Detail</a>
                            <a class="nav-item nav-link" id="nav-vanue-tab" data-toggle="tab" href="#nav-vanue" role="tab" aria-controls="nav-vanue"
                                aria-selected="false">Event Vanue</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Contact</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">
                            <p><strong>Title : </strong>{{$event_post->title}}</p>
                            <p><strong>Category : </strong>{{$event_post->category_name}}</p>
                            <p><strong>Thumbnail : </strong><br><img src="{{asset('assets/event/thumbnail/'.$event_post->thumbnail)}}" style="height: 150px; width: 250px;"  alt=""></p>
                            <p><strong>Date: </strong>{{ Carbon\Carbon::parse($event_post->start_date)->format('d M') }} ({{$event_post->start_time}}) - {{  Carbon\Carbon::parse($event_post->end_date)->format('d M') }}({{$event_post->end_time}})</p>
                            <p><strong>Tags : </strong>{{$event_post->tags}}</p>
                            <p><strong>About Event : </strong>{!!$event_post->about_event!!}</p>
                            
                        </div>
                        <div class="tab-pane fade" id="nav-vanue" role="tabpanel" aria-labelledby="nav-vanue-tab">
                            @if($event_post->event_type == 'offline')
                            <p><strong>Location : </strong>{{$event_post->state}} ({{$event_post->city}})</p>
                            <p><strong>Address : </strong>{{$event_post->address}}</p>
                            <p><strong>Pincode : </strong>{{$event_post->pin_code}}</p>
                            <p><strong>Email : </strong>{{$event_post->email}}</p>
                            <p><strong>Phone Number : </strong>{{$event_post->phone_number}}</p>
                            @else
                            <p> This Event Is Online. </p>
                            @endif

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <p><strong>Name : </strong>{{$event_post->user_name}}</p>
                        <p><strong>Email : </strong>{{$event_post->user_email}}</p>
                        <p><strong>Website : </strong>{{$event_post->user_website}}</p>
                        <p><strong>Phone no : </strong>{{$event_post->user_number}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection