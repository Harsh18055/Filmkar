@extends('admin/layout')
@section('page_title','Manage Chatbot')
@section('language_select','active')
@section('container')
    <h1 class="mb10">Manage Chatbot</h1>
    <a href="{{url('admin/chatbot')}}">
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
                            <form action="{{route('chatbot.manage_chatbot_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                 @error('question')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                <div class="form-group">
                                    <label for="question" class="control-label mb-1">Question</label>
                                    <input id="question" value="{{$question}}" name="question" type="text" class="form-control" required placeholder="Enter Question" >
                                     <label for="answer" class="control-label mb-1">Answer</label>
                                    <input id="answer" value="{{$answer}}" name="answer" type="text" class="form-control" required placeholder="Enter Answer" >
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