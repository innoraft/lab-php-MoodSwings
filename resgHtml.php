<!-- This file deals with registering a new user to the portal -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Moodswing | Register</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">

	<!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="assets/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- This is for the default theme of the validator plugin -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container">

          <form action="resg.php" class="form-signin" method="post" id="register-form">
			<div class="top"><h1 id="title" class="hidden"><span id="logo">Moodswings</span></h1></div>
			<div class="login-box animated fadeInUp">
				<div class="box-header"><h2>Sign Up</h2></div>
				<!-- Error dialog where the error messages will be displayed -->
				<div id="error-dialog" class="form-control"></div>

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

				<!-- Label and input for password		   -->
				<label for="password">Password</label><br>
				<input type="password"
						  id="password"
						  name="password"
						  data-validation="strength"
		 		   		  data-validation-strength="2"
						  data-validation-error-msg-container="#error-dialog"><br>
						 <span class="strength-meter"></span>

                    <br/>

				<!-- Label and input for confirm password -->
				<label for="password">Confirm Password</label>
				<input type="password"
						  id="pass"
						  name="pass"
						  data-validation-confirm="password"
						  data-validation-error-msg="Your passwords do not match"
						  data-validation-error-msg-container="#error-dialog">
				<br/>

				<!-- Button to submit the form -->
				<button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">Sign Up</button>
				<br/>
			</div>
		</form>

	</div>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<!-- Script to validate the form -->
<script>
	$.validate({
		modules : 'security',
		onModulesLoaded : function() {
		// The config variable stores the attributes of the paasword strength-meter
    		var config = {
      	fontSize: '12pt',
      	padding: '4px',
      	bad : 'Very bad',
      	weak : 'Weak',
      	good : 'Good',
      	strong : 'Strong'
    };

	// displayPasswordStrength() function is responsible for displaying the strength-meter while typing
    $('input[name="password"]').displayPasswordStrength(config);
  }
	});
</script>

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

</html>
