<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<!--STYLESHEETS-->
<link href="css/login.css" type="text/css" rel="stylesheet" />

<!--SCRIPTS-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".email").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".email").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="login_user.php" method="post">

	<!--HEADER-->
    <div class="header">
    <img src="images/logo-black.png" alt="logo" />
    <hr>
    <!--TITLE--<h1>Admin Login</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Sign In To Your Account</span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="email" type="email" placeholder="E-Mail" class="input email" value="email" onfocus="this.value=''" /><!--END USERNAME-->
    <!--PASSWORD--><input name="password" type="password" placeholder="Password" class="input password" value="Password" onfocus="this.value=''" /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><button type="submit" name="submit" value="" class="utton new_btn new_btn_tr" id="btn">Sign In</button><!--END LOGIN BUTTON-->
     <a>Forgot Password?</a>
    </div>
    <div>
    	
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>