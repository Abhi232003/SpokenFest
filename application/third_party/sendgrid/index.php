
<?php
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require './vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
	// You need this API_KEY created on the Sendgrid website.
	include_once('./credentials.php');
	
	$FROM_EMAIL = 'info@acetute.com';
	// they dont like when it comes from @gmail, prefers business emails
	$TO_EMAIL = 'imran@4fox.in';
	// Try to be nice. Take a look at the anti spam laws. In most cases, you must
	// have an unsubscribe. You also cannot be misleading.
	$subject = "Test Sendgrid email";
	$from = new SendGrid\Email(null, $FROM_EMAIL);
	$to = new SendGrid\Email(null, $TO_EMAIL);
	$htmlContent = '<html>

<body>
	<div style="background-color: #f1f1f1;padding-top: 20px;padding-bottom: 30px;">
		<h1 style="font-size: 24px;">My Company</h1>
		<div style="width: 90%;margin-left: auto;margin-right: auto;background-color: #fff">
			<p>
				This is an example.
			</p>
		</div>
	</div>
</body>
</html>';
	// Create Sendgrid content
	$content = new SendGrid\Content("text/html",$htmlContent);
	// Create a mail object
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
	
	$sg = new \SendGrid($API_KEY);
	$response = $sg->client->mail()->send()->post($mail);
	echo'<pre>';print_r($response);
	if ($response->statusCode() == 202) {
		// Successfully sent
		echo 'done';
	} else {
		echo 'false';
	}
?>