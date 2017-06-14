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

</head>

<body>
	<div class="container">

          <form  class="form-signin" id="register-form">

			<div class="top">
				<h1 id="title" class="hidden"><span id="logo">Moodswings</span></h1>
			</div>
			<div class="login-box animated fadeInUp">
				<div class="box-header">
					<h2>Sign Up</h2>
				</div>
				<label for="username">Username</label>
				<br/>
				<input type="text" id="user_email" name="user_email" class="form-control">
				<div>
					<span id="error_message" class="text-danger">&nbsp;</span>
					<span id="success_message" class="text-success">&nbsp;</span>
				</div>
				<br/>
				<label for="password">Password</label>
				<br/>
				<input type="password" id="password" name="password" class="form-control">
				<br/>
                    <br/>
				<label for="password">Confirm Password</label>
				<br/>
				<input type="password" id="cpassword" name="cpassword">
				<br/>
				<button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">Sign Up</button>
				<br/>
			</div>
			<div id="success_message"></div>
		</form>
	</div>
</body>

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

<script>
$(document).ready(function(){
     $('#btn-submit').click(function(){
          var email = $('#user_email').val();
           var allowedDomains = [ 'innoraft.com' ];
           var domain = $("#user_email").val().split("@")[1];
          if(email == '')
          {
               $('#error_message').html('<font color="red"><b>Email required</b></font>');
          }
          else
          {
             if ($.inArray(domain, allowedDomains) !== -1)
             {
                $('#error_message').html('');
               $.ajax({
                    url:"resg.php?email="+email+"&password="+password+,
                    type:"GET",
                    //data:{email:email},
                    success:function(data){
                         $("form").trigger("reset");
                         $('#success_message').css('visibility', 'visible').html(data);
                         setTimeout(function(){
                              $('#success_message').css('visibility', 'hidden');
                         }, 3000);
                    }
               });

             }
             else{
                     $('#error_message').html('<font color="red"><b>Unauthorized Domain name</b></font>');
             }
          }
     });
});
</script>
</html>
