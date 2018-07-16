﻿<!DOCTYPE html>

<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';


sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
    $message = "Du bist bereits eingeloggt!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header('Location: http://141.99.248.92/Projektgruppe');
	exit;
} else {
    $logged = 'out';

}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <!-- user-scalable für mobile devices -->
    <meta name="description" content="...">
    <meta name="author" content="...">

    <title>Login </title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style_login.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />


</head>

<body class="login-img3-body">


    <!-- include Navbar -->
	<?php
		include ("php/include/navbar.php");
	?>
    <div class="container">
        
        <?php
        if (isset($_GET['error'])) {
        echo '<p class="error">Error Logging In!</p>';
        }
        ?>

        <form action="php/include/login_process.php" method="post" name="login_form">
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control"  name ="email" placeholder="Email" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control" name ="password" id="password" placeholder="Passwort">
                </div>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
                </label>
                <input class="btn btn-primary btn-lg btn-block" type="button" value="Login" onclick="formhash(this.form, this.form.password);"/>
               
            </div>
        </form>
        <button class="btn btn-info btn-lg btn-block" type="submit" onclick="window.location.href='php/register.php'">Signup</button>

    </div>

    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
</body>

</html>
