<html>
    <head>
       <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap-select.min.css')}}">
<link href="{{asset('assets/plugins/icons/css/icons.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap/css/bootsnav.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/plugins/nice-select/css/nice-select.css')}}">
<link href="{{asset('assets/plugins/aos-master/aos.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </head>
    <body>
        <p>Hi {{ $details['telent_name'] }}, We have got an enquiry for your Profile on Filmkar.com . Check this enquiry and initiate a convertation with the below given Profile.&nbsp;</p>
        <p><br></p>
        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
        NAME: {{ $details['name'] }}<br>
        Email: {{ $details['email'] }}<br>
        phone: {{ $details['phone'] }}<br>
        subject: {{ $details['subject'] }}<br>
        message: {{ $details['message'] }}<br>
        </p>
        <p><br></p>
        <p><br></p>
        <p>For instant updates follow us on -</p>
        <li><a href="{{ DB::table('settings')->first()->facebook }}" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="{{ DB::table('settings')->first()->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <p><br></p>
        <p><br></p>
        <p>Imp Note :</p>
        <p><br></p>
        <p>Filmkar or its officials will never ask for money to provide work to you.</p>
        <p>Do not Send Money without verification to Anyone. Avoid Scams and Fraud!</p>
        <p>Stay away from people who are charging money for fraudulent activities like making &nbsp;artist card or buy any insurance to give work.</p>
        <p>Beware of getting advance cheque and sending money back through Western unions Moneygram, wire transfer.</p>
        <p>It&apos;s the duty of the talent or organisation to check identity and intention of the contact person as we cannot give guarantee of professional association or affiliation and human intention/behaviour.</p>
        <p><br></p>
        <p><br></p>
        <p>&nbsp; &nbsp; Warm Regards</p>
        <p>Team Filmkar.com</p>
        <p><br></p>
        <p><br></p>
        <p><br></p>
        <p>You are receiving this mail as a registered member of Filmkar.com. Please add <a data-fr-linked="true" href="mailto:web@filmkar.com">web@filmkar.com</a> to your address book to ensure delivery into your inbox. Click here to unsubscribe. Filmkar.com is not responsible for content other than its own and makes no warranties or guarantees about the products or services that are advertised.</p>
        <p><br></p>
    </body>
</html>
