@extends('front/layout')
@section('page_title','Blog Details')
@section('blog_select','active')
@section('nav_class','white no-background')
@section('container')

<style>
    @media only screen   
   and (min-device-width : 360px)   
   and (max-device-width : 640px)  
   {
    .padding{
        padding: 3px;
    }
   }
   /* For 1024 Resolution */  
   @media only screen   
   and (min-width: 1370px)  
   and (max-width: 1605px) 
   { 
    .padding{
        padding: 150px;
    }
   } 
   #editerclass img{
  width: 600px;
  height: 338px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding-top: 21px;
   }
   
   #editerclass img link:a {
       color:red;
   }
   
   #editerheding h4{
       color:black;
  font-size: 39px;
  text-align: center;
  padding-top: 17px;
   }
   
   #editerclass p{
  font-size: 17px;
  font-size: initial;
  line-height: 41px;
  
   }
   .media {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Blog Detail</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> BLog Detail</p>
    </div>
  </div>
</div>
<section class="padd-top-80 padd-bot-60">
  <div class="container"> 
    <!-- row -->
    <div class="row">
      <div class="col-md-12 col-sm-10">
        <div class="detail-wrapper mb-3">
          <div class="" id="editerheding">
            <h4 >{{$signleblog->title}}</h4>
          </div>
          <div class="detail-wrapper-body " id="editerclass">
            <p>{!!$signleblog->blog!!}</p>
            <figure class="media">
    <o-embed url="https://media-url"></o-embed>
</figure>
        </div>
  </div>
</section>
@endsection
<!-- Add the following script to handle the YouTube video rendering -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Loop through each <oembed> element
    $('oembed').each(function() {
      // Get the YouTube video URL
      var youtubeURL = $(this).attr('url');

      // Extract the YouTube video ID from the URL
      var videoID = youtubeURL.split('v=')[1];

      // Generate the embedded YouTube video HTML
      var embeddedVideoHTML = '<iframe width="600" height="338" src="https://www.youtube.com/embed/' + videoID + '" frameborder="0" allowfullscreen></iframe>';

      // Replace the current <oembed> tag with the embedded video HTML
      $(this).parent('.media').html(embeddedVideoHTML);
    });
  });
</script>
