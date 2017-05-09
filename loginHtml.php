<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>News_today</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>

<div class="signin-form">

    <div class="container">


        <form action="loggin.php" class="form-signin" method="post" id="register-form">

            <h2 class="form-signin-heading">Login</h2><hr />

            <div id="error">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email address" name="user_mail" id="user_email" />
                <span id="check-e"></span>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="user_password" id="password" />
            </div>

            <hr />

            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-login" id="btn-submit">
                  Login
                </button>
            </div>

        </form>

    </div>

</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>