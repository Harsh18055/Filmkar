@extends('front/layout')
@section('page_title','Film Maker')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Terms And Conditions</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> terms & conditions</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-70">
  <div class="container">
    <div class="col-md-12 col-sm-12">
        <p>{!! DB::table('pages')->where('id','1')->first()->terms_and_conditions !!}</p>
    </div>
  </div>
</section>
@endsection
