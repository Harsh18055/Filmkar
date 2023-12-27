@extends('front/layout')
@section('page_title','Discussion')
@section('discussion_select','active')
@section('nav_class','white no-background')
@section('container')

<style>
    .container-fluid
    {
        padding-top: 18px;
        padding-bottom: 50px;
        margin-left:400px;
        
    }
    .card {
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 600px;
  }

  .alert.alert-danger {
    padding: 10px;
    margin: 10px;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    border-radius: 5px;
  }
</style>

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Our Discussion</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i>Our Discussion</p>
    </div>
  </div>
</div>

<!--Start Data-->
<div class="container-fluid">
    <div class="row ">
        <div class="col">
            <a href="">
                <div class="alert alert-danger card">
                    What is a Filmkar?
                </div>
            </a>
        </div>
    </div>
</div>
  
<!--End Data-->

@endsection