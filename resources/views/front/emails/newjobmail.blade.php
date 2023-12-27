<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>New Jobs Available</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			padding: 20px;
			color: #444;
		}
		.container {
			max-width: 600px;
			margin: 0 auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
		}
		h1 {
			font-size: 24px;
			font-weight: bold;
			margin-top: 0;
			margin-bottom: 20px;
			color: #333;
		}
		p {
			margin-top: 0;
			margin-bottom: 20px;
			font-size: 16px;
			line-height: 1.5;
		}
		a {
			color: #007bff;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<!--<h1>New Jobs Available</h1>-->
		<!--<p>Dear {{ $details['username'] }},</p>-->
		<!--<p>We are excited to inform you that {{$details['jobscount']}} new jobs have been added to our website. These jobs match your skills and experience, and we think you would be a great fit for them.</p>-->
		<!--<p>To view the new jobs, please click on the link below:</p>-->
		<!--<p><a href="{{route('jobs.filter', ['category_id' => $details['cat_id']])}}">View New Jobs</a></p>-->
		<!--<p>Thank you for using our website.</p>-->
		<!--<p>Best regards,</p>-->
		<!--<p>Filmkar Team</p>-->
		<!--<a href="https://filmkar.com/">www.filmkar.com/</a>-->
		<p>Hi {{ $details['username'] }}, We have got a Job recommendation for you which matches your profile . Check this Job and initiate a conversation with the team.&nbsp;</p>

<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="{{route('jobs.filter', ['category_id' => $details['cat_id']])}}"> JOB LINK </a></p>

<p>For instant updates follow us on - fb, Insta all logos with link.</p>

<p><br />
Imp Note :</p>

<p>Filmkar or its officials will never ask for money to provide work to you.<br />
Do not Send Money without verification to Anyone. Avoid Scams and Fraud!<br />
Stay away from people who are charging money for fraudulent activities like making artist card or buy any insurance to give work.<br />
Beware of getting advance cheque and sending money back through Western unions Moneygram, wire transfer.<br />
It&#39;s the duty of the talent or organisation to check identity and intention of the contact person as we cannot give guarantee of professional association or affiliation and human intention/behaviour.</p>

<p>Team - Filmkar.com<br />
For Happy Filmmaking</p>

<p>You are receiving this mail as a registered member of Filmkar.com. Please add&nbsp;web@filmkar.com&nbsp;to your address book to ensure delivery into your inbox. Click here&nbsp;to unsubscribe. Filmkar.com is not responsible for content other than its own and makes no warranties or guarantees about the products or services that are advertised.<br />
&nbsp;</p>

	</div>
</body>
</html>
