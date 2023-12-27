@extends('front/layout')
@section('page_title','Contact')
@section('home_select','active')
@section('nav_class','white no-background')
@section('container')

    <!-- {!! RecaptchaV3::initJs() !!} -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Get In Touch</h2>
      <p><a href="{{route('home')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Contact</p>
    </div>
  </div>
</div>

<section class="padd-top-80 padd-bot-70">
  <div class="container">
    <div class="col-md-6 col-sm-6">
      @if(session()->has('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}
      </div>
      @endif
      @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @endif
      <div class="row">
        <form class="mrg-bot-40" id="contactUSForm" action="{{route('contact.submit')}}" method="post">
          @csrf
          <div class="col-md-12 col-sm-12">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Name" required />
          </div>
          <div class="col-md-6 col-sm-6">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required />
          </div>
          <div class="col-md-6 col-sm-6">
            <label>Phone No:</label>
            <input type="text" class="form-control" name="phone_no" placeholder="Phone no" pattern="[0-9]{10}"
              title="Please enter 10 numbers" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)"
              required>
          </div>
          <div class="col-md-12 col-sm-12">
            <label>Subject:</label>
            <input type="text" class="form-control" name="subject" placeholder="Subject" required />
          </div>

          <div class="col-md-12 col-sm-12">
            <label>Message:</label>
            <textarea class="form-control height-120" name="message" placeholder="Message" required></textarea>
          </div>

          <div class="col-md-12 col-sm-12 g-recaptcha" data-sitekey="6LdY8sYoAAAAAP39zQahcV6YLraXW6qUL5IcwboC" style="margin-bottom: 2%;">
            @if ($errors->has('g-recaptcha-response'))
            <div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
                    <p class="mb-0">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </p>
                  </div>
                                @endif
          </div>


          <div class="col-md-12 col-sm-12 mt-2">
            <!-- <button class="btn theme-btn" type="submit" name="submit">Send Message</button> -->
            <button class="btn theme-btn" type="submit" name="submit" value="submit">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection