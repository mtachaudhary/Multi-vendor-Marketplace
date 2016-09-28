<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign-in & Register | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link rel="stylesheet" href="Bazzar-CSS/bootstrap.min.css"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet"/>
    
    <script src="Bazzar-JQuery/jquery.min.js" ></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
    <script src="Bazzar-JQuery/custom-js.js"></script>
    <style>
    	.first-footer { display:none}
		footer { border-top:none}
    </style>
</head>

<body>
    <div class="container-fluid nopadding">
        
        <!--Start PHP-->
        <?php
            include('db_session.php');
			if(isset($_GET['user']))
			{
				if($_GET['user']=='register')
				{
					register();
				}
				if($_GET['user']=='login')
				{
					login_user();
				}
				if($_GET['user']=='logout')
				{
					logout_user();
				}
			}
			function register()
			{
				db();
				$email=$_POST['email'];
				$re_email=$_POST['re_email'];
				$password=$_POST['pswd'];
				$f_name=$_POST['f_name'];
				$l_name=$_POST['l_name'];
				$phone=$_POST['tel'];
				$offers=@$_POST['offers'];
				$query="INSERT INTO register_user (email, password, f_name, l_name, phone, bazzar_offers) VALUES('$email','$password','$f_name','$l_name','$phone','$offers')";
				$execute=mysql_query($query);
				if($execute)
				{
					echo '<script>alert("You are successfully registered!");</script>';
					echo '<script>window.location="login-form.php";</script>';
				}
				else
				{
					echo mysql_error();
				}
			}
			function login_user()
			{
				db();
				$email = $_POST['em-login'];
				$password = $_POST['pw-login'];
				if(isset($_POST['vendor']))
				{
					$query_vd = "SELECT * FROM register_vendor WHERE email='".$email."' and password='".$password."'";
					$exe_vd = mysql_query($query_vd);
					if($exe_vd)
					{
						
						if(mysql_num_rows($exe_vd)>0)
						{
							$data_vd = mysql_fetch_object($exe_vd);
							
							if($data_vd->status=='approve'){
							$_SESSION['v_id'] = $data_vd->id;
							$_SESSION['business_name'] = $data_vd->business_name;
							$_SESSION['first_name'] = $data_vd->f_name;
							$_SESSION['last_name'] = $data_vd->l_name;
							$_SESSION['type_vd'] = $data_vd->type;
							$_SESSION['v_email'] = $data_vd->email;
							$_SESSION['country'] = $data_vd->country;
							$_SESSION['business_address'] = $data_vd->business_address;
							$_SESSION['business_city'] = $data_vd->business_city;
							$_SESSION['business_state'] = $data_vd->business_state;
							$_SESSION['business_phone'] = $data_vd->business_phone;
							$_SESSION['business_zip'] = $data_vd->business_zip;
							$_SESSION['personal_address'] = $data_vd->personal_address;
							$_SESSION['personal_city'] = $data_vd->personal_city;
							$_SESSION['personal_state'] = $data_vd->personal_state;
							$_SESSION['personal_phone'] = $data_vd->personal_phone;
							$_SESSION['personal_zip'] = $data_vd->personal_zip;
							$_SESSION['about'] = $data_vd->about;
							$_SESSION['profile_pic'] = $data_vd->profile_pic;
							$_SESSION['payment_type'] = $data_vd->payment_type;
							$_SESSION['card_number'] = $data_vd->card_number;
							$_SESSION['security_code'] = $data_vd->security_code;
							$_SESSION['expiration_date'] = $data_vd->expiration_date;
							header('location:vendor/index.php');
							}
							else{
								echo "<script>alert('You Are Not Registered')</script>";
								}
						}
						else
						{
							echo '<div class="alert alert-warning alert-dismissable" style="position:absolute; z-index:11111; min-width: 285px;" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> Vendor not found \ Invalid Email or Password.</div>';
						}
					}
					else
					{
						echo mysql_error();
					}
				}
				else
				{
					$query="SELECT * FROM register_user WHERE email='".$email."' and password='".$password."'";
					$execute=mysql_query($query);
					if($execute)
					{
						if(mysql_num_rows($execute)>0)
						{
							$data=mysql_fetch_object($execute);
							$_SESSION['id']=$data->id;
							$_SESSION['email']=$data->email;
							$_SESSION['first_name']=$data->f_name;
							$_SESSION['last_name']=$data->l_name;
							$_SESSION['phone']=$data->phone;
							$_SESSION['city']=$data->city;
							$_SESSION['address']=$data->address;
							$_SESSION['pic']=$data->prof_pic;
							$_SESSION['skype']=$data->skype;
							$_SESSION['fb']=$data->fb_url;
							
							header('location:user_profile.php');
						}
						else
						{
							echo '<div class="alert alert-warning alert-dismissable" style="position:absolute; z-index:11111; min-width: 285px;" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> User not found \ Invalid Email or Password.<br>If you are vendor then check <b>Sign In As A Vendor</b></div>';
						}
					}
					else
					{
						echo mysql_error();
					}
				}
			}
			
			function logout_user()
			{
				session_destroy();
				header('location:login-form.php');
			}
			//Start Header
			include('header.php');
        ?>
        <!--END PHP-->
        
        <!--Start Form body-->
        <div class="background">
            <div class="my-form container" >
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-5 col-md-offset-4 col-md-5">
                        
                        <!--Start Login Form-->
                        <div class="form-box">
                            <div class="form-top">
                                
                                <!--Start Form Tab-->
                                <div class="row">
                                    <div>
                                        <ul class="nav nav-tabs col-sm-12 top-tab">
                                            <li class="active col-sm-6 nopadding top-sgn">
                                                <a class="top-tabs" data-toggle="tab" href="#sign-in">Sign In</a>
                                            </li>
                                            <li class="col-sm-6 nopadding top-rgn">
                                                <a class="top-tabs" data-toggle="tab" href="#register">Register</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--END Form Tab-->
                                
                             </div>
                            <div class="form-bottom">
                                <div class="tab-content">
                                	
                                    <!--Sign-In Form Start-->
                                    <div class="tab-pane active" id="sign-in">
                                        <form action="login-form.php?user=login" method="post" class="form-horizontal log-in">
                                            <div class="form-group">
                                                <div class="col-sm-12 nopadding">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input type="email" id="em" class="form-control" name="em-login" placeholder="Enter Email"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <div class="col-sm-12 nopadding">
                                                        <input type="password" placeholder="Enter Password" name="pw-login" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin:0 -15px 5px">
                                                <input type="checkbox" name="vendor" id="vend"/>
                                                <label for="vend">Sign In As A Vendor?</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 nopadding">
                                                    <button type="submit" class="btn btn-primary btn-block btn-sgn">Sign in</button>
                                                </div>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                	<input type="checkbox" /> Stay signed in
                                                </label>
                                                <div class="fg-pwd">
                                                	<a href="#/">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <p style="margin:10px -15px 0">Don't have an account? <span style="color:#df2e1b;">Register now.</span></p>
                                        </form>
                                    </div>
                                	<!--Sign-In Form End  --> 
                                
                                	<!--Registeration Form Start-->
                                    <div class="tab-pane fade" id="register">
                                        <form action="login-form.php?user=register" method="post" class="form-horizontal log-in">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input type="email" class="form-control" name="re_email" placeholder="Re-enter Email"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <div class="col-sm-12 nopadding">
                                                        <input type="password" placeholder="Enter Password" name="pswd" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="f_name" placeholder="First Name"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="l_name" placeholder="Last Name"/>
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            	<input type="tel" class="form-control" name="tel" id="phone" placeholder="Phone Number"/>
                                            </div>
                                            <div class="checkbox">
                                                <input type="checkbox" name="offers" value="1" id="rcv" checked>
                                                <label for="rcv">Receive exclusive offers and promotions from 
                                                	<a id="bazzar" href="index.php" target="_blank">BAZzAR</a>
                                                </label>   
                                            </div>
                                            <p class="ref">
                                            	By clicking Register, you agree that you have read and accepted the <a id="bazzar" href="index.php" target="_blank">BAZzAR</a> User Agreement and User Privacy Notice and that you are at least 18 years old.
                                            </p>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block btn-sgn">Register</button>
                                                <hr>
                                            </div> 
                                            <div class="sugest">
                                                <h4>WANT TO JOIN AS A BUSINESS?</h4>
                                                <p><a href="signup-form.php">Register for a business account</a></p>
                                            </div>
                                        </form>
                                    </div>
                                	<!--Registration Form End-->
                                    
                                </div>
                        	</div>
                        </div>
                        <!--END Login Form-->
                        
                    </div>
                </div>
            </div>
        </div>
        <!--END Form body-->
        
    </div>
    
    <!--Start Footer-->
    <?php
    	include('footer.php');
    ?>
    <!--END Footer-->
</body>
</html>
