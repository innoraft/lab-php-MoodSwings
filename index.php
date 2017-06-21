<!-- This file deals with logging in an existing user into the portal -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Moodswing | Login</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">

	<!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="assets/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- This is for the default theme of the plugin -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container">
      <form action="login.php" class="form-signin" method="post" id="register-form">

			<div class="top"><h1 id="title" class="hidden"><span id="logo">Moodswings</span></h1></div>
			<div class="login-box animated fadeInUp">
			<div class="box-header"><h2>Log In</h2></div>

				<!-- Label and input for email id -->
				<label for="username">Username</label><br>
				<input type="text"
						  id="email"
						  name="email"
						  pattern="[a-z0-9._%+-]+@[innoraft]+\.[a-z]{2,3}$"
						  data-validation="email"
						  data-validation-error-msg-container="#error-dialog"
						  data-validation-error-msg="You did not enter a valid e-mail">
				<br/>

				<!-- Label and input for password -->
				<label for="password">Password</label><br>
				<input type="password"
						  id="password"
						  name="password"
						  >
                    <br/>

				<button type="submit" class="btn btn-default" name="btn-login" id="btn-submit">Log In</button>
				<button type="submit" class="btn btn-default" name="btn-resg" id="btn-resg">Sign Up</button>
				<br/>
				<br/>
				<a href="forgot.php">Forgot password?</a>
				<!-- Error dialog where the error messages will be displayed -->
				<div id="error-dialog" class="form-control"></div>
			</div>
	</div>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<!-- Script to animate the login box elements -->
<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

<!-- Script to validate the form -->
<script>
	$.validate({
		modules : 'security',
	});
</script>

</html>
