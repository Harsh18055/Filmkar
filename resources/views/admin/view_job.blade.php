@extends('admin/layout')
@section('page_title','Manage Job')
@section('job_select','active')
@section('container')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Job Posts Details</h4>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-job-tab" data-toggle="tab" href="#nav-job" role="tab" aria-controls="nav-home"
                                aria-selected="true">Job Detail</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Profile</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Contact</a>
                        </div>
                    </nav>
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-job" role="tabpanel" aria-labelledby="nav-job-tab">
                            <p><strong>Title : </strong>{{$job_posts->title}}</p>
                            <p><strong>Description : </strong>{!! $job_posts->description !!}</p>
                            <p><strong>Job Role : </strong>{{$job_posts->category_name}}</p>
                            <p><strong>Gender : </strong>{{$job_posts->gender}}</p>
                            <p><strong>MinAge : </strong>{{$job_posts->MinAge}}</p>
                            <p><strong>MaxAge : </strong>{{$job_posts->MaxAge}}</p>
                            <p><strong>Audition Required : </strong>{{$job_posts->audition_required}}</p>
                            <p><strong>Budget : </strong>{{$job_posts->budget}}</p>
                            <p><strong>Budget Duration : </strong>{{$job_posts->budget_duration}}</p>
                            <p><strong>Last Date For Apply : </strong>{{$job_posts->last_date}}</p>
                            <p><strong>Job Start : </strong>{{$job_posts->job_start}}</p>
                            <p><strong>Job End : </strong>{{$job_posts->job_end}}</p>
                            <p><strong>No Of Vacancies : </strong>{{$job_posts->No_of_vacancies}}</p>
                            <p><strong>State : </strong>{{$job_posts->state}}</p>
                            <p><strong>City : </strong>{{$job_posts->city}}</p>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <p><strong>Name : </strong>{{$job_posts->name}}</p>
                        <p><strong>Company : </strong>{{$job_posts->company}}</p>
                        <p><strong>About Company : </strong>{{$job_posts->about_company}}</p>

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <p><strong>Email : </strong>{{$job_posts->email}}</p>
                        <p><strong>Website : </strong>{{$job_posts->website}}</p>
                        <p><strong>Phone no : </strong>{{$job_posts->phone_no}}</p>
                        <p><strong>Whatsapp No : </strong>{{$job_posts->whatsapp_no}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection