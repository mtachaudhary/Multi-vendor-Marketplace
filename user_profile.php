<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Profile | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link rel="stylesheet" href="Bazzar-CSS/bootstrap.min.css"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet"/>
    
    <script src="Bazzar-JQuery/jquery.min.js" ></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
    <script src="Bazzar-JQuery/custom-js.js"></script>
</head>

<body>

	<div class="container-fluid nopadding">
    	<!-- Start Header -->
		<?php
			include('db_session.php');
            include('header.php');
			
			db();
			$q_select="SELECT * FROM register_user WHERE id='".$_SESSION['id']."'";
			$q_select_exe=mysql_query($q_select);
			$data_update=mysql_fetch_object($q_select_exe);
			
			if(isset($_GET['user']))
			{
				if($_GET['user']=='update_info')
				{
					update_info();
				}
				if($_GET['user']=='update_password')
				{
					update_password($data_update->password);
				}
			}
			
			function update_info()
			{
				if(isset($_POST['f_nm']))
				{
					$path=explode('.', $_FILES['photo']['name']);
					$extension=$path[count($path)-1];
					
					$query="UPDATE register_user SET ";
					$query.="f_name='".$_POST['f_nm']."',";
					$query.="l_name='".$_POST['l_nm']."',";
					$query.="phone='".$_POST['phone']."',";
					$query.="prof_pic='".$extension."',";
					$query.="city='".$_POST['city']."',";
					$query.="address='".$_POST['address']."',";
					$query.="skype='".$_POST['skype']."',";
					$query.="fb_url='".$_POST['fb']."'";
					$query.=" WHERE id='".$_SESSION['id']."'";
					$execute = mysql_query($query);
					$img_path = move_uploaded_file($_FILES['photo']['tmp_name'],"images/profile_pics/user_profile_pic(".$_SESSION['id'].").$extension");
					if($execute)
					{
						if($img_path)
						{
							echo "<script>window.location='user_profile.php';</script>";
						}
					}
					else
					{
						echo mysql_error();
					}
				}
			}
			
			function update_password($c_password)
			{
				if(isset($_POST['current_pw']))
				{
					if($_POST['current_pw']==$c_password)
					{
						if($_POST['new_pw']==$_POST['confirm_pw'])
						{
							db();
							$q_password = "UPDATE register_user SET password='".$_POST['new_pw']."' WHERE id='".$_SESSION['id']."'";
							$exe = mysql_query($q_password);
							if($exe)
							{?>
								<script>
                                	alert('Password changed successfully!\n Your new password : <?php echo $_POST['new_pw']; ?>');
									window.location='user_profile.php';
                                </script>
							<?php
                            }
							else
							{
								echo mysql_error();
							}
						}
						else
						{?>
							<script>
								alert('Confirm password not match!');
								window.location='user_profile.php';
							</script>
						<?php
                        }
					}
					else
					{?>
						<script>
							alert('Wrong current password!');
							window.location='user_profile.php';
						</script>
					<?php
                    }
				}
			}
        ?>
        <!-- END Header -->
        
        <!-- Start User Profile -->
        <div class="container main-container">
        	<h1>My Profile</h1>
            <div class="row">
            	
                <!-- Start Left-Column -->
                <div class="col-md-3 my-profile">
                	<img src="images/profile_pics/user_profile_pic(<?php echo $_SESSION['id'].").".$_SESSION['pic']; ?>" class="img-thumbnail" alt="Choose your profile photo!"/>
                    <table class="table profile_table">
                    	<tr>
                        	<th colspan="2">Personal Information</th>
                        </tr>
                        <tr>
                        	<td><label>Name</label></td>
                            <td><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>Email</label></td>
                            <td><?php echo $_SESSION['email']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>Phone No.</label></td>
                            <td><?php echo $_SESSION['phone']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>Address</label></td>
                            <td><?php echo $_SESSION['address']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>City</label></td>
                            <td><?php echo $_SESSION['city']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>Skype ID</label></td>
                            <td><?php echo $_SESSION['skype']; ?></td>
                        </tr>
                        <tr>
                        	<td><label>Facebook Link</label></td>
                            <td><a href="<?php echo $_SESSION['fb']; ?>" target="_blank">My Facebook Profile >></a></td>
                        </tr>
                    </table>
                </div>
                <!-- END Left-Column -->
                
                <!-- Start Right-Column -->
                <div class="col-md-9">
                	<div class="profile_body">
                    	
                        <!-- Start Service Block -->
                        <div class="row">
                        	<div class="col-sm-6">
                            	<div class="service-block">
                                	<div>
                                    	<i class="fa fa-shopping-cart"></i>
                                        <span class="service-heading">Total Purchase</span>
                                        <span class="counter">PKR0.00</span>
                                    </div>
                                    <div class="row service-out">
                                    	<div class="col-xs-6 service-in">
                                        	<small>Last 7 Days</small>
                                            <h4 class="counter">PKR0.00</h4>
                                        </div>
                                        <div class="col-xs-6 service-in srv-in2">
                                        	<small>Last 30 Days</small>
                                            <h4 class="counter">PKR0.00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                            	<div class="service-block srv-blk2">
                                	<div>
                                    	<i class="fa fa-heart"></i>
                                        <span class="service-heading">Wished Products</span>
                                        <span class="counter">0</span>
                                    </div>
                                    <div class="row service-out">
                                    	<div class="col-xs-6 service-in">
                                        	<small>User Since</small>
                                            <h4 class="counter">27 Apr, 2016</h4>
                                        </div>
                                        <div class="col-xs-6 service-in srv-in2">
                                        	<small>Last Login</small>
                                            <h4 class="counter">28 Apr, 2016</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Service Block -->
                        
                        <!-- Start Tabs -->
                        <div>
                        	<ul class="nav nav-tabs" role="tablist">
                            	<li role="presentation" class="active">
                                	<a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Purchase History</a>
                                </li>
                                <li role="presentation">
                                	<a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Wishlist</a>
                                </li>
                                <li role="presentation">
                                	<a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">Edit Info</a>
                                </li>
                                <li role="presentation">
                                	<a href="#tab-4" aria-controls="tab-4" role="tab" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            	<div class="tab-pane active" id="tab-1" role="tabpanel">
                                	<table class="table">
                                    	<thead>
                                        	<tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Payment Status</th>
                                                <th>Delivery Status</th>
                                                <th>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<tr>
                                            	<td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2" role="tabpanel">
                                	<table class="table">
                                    	<thead>
                                        	<tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Availability</th>
                                                <th>Purchase</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<tr>
                                            	<td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-3" role="tabpanel">
                                	<div class="edit-info">
                                    	<form method="post" action="user_profile.php?user=update_info" enctype="multipart/form-data">
                                        	<div class="edit-form">
                                                <label for="f-nm">First Name:</label>
                                                <div class="input-group">
                                                    <input type="text" name="f_nm" value="<?php echo $data_update->f_name; ?>" id="f-nm" class="form-control" title="Change your First Name" aria-describedby="f-nm"/>
                                                    <span class="input-group-addon" id="f-nm"><i class="fa fa-user"></i></span>
                                                </div>
                                                <label for="l-nm">Last Name:</label>
                                                <div class="input-group">
                                                    <input type="text" name="l_nm" value="<?php echo $data_update->l_name; ?>" id="l-nm" class="form-control" title="Change your Last Name" aria-describedby="l-nm"/>
                                                    <span class="input-group-addon" id="l-nm"><i class="fa fa-user"></i></span>
                                                </div>
                                                <label for="tel-nm">Phone #:</label>
                                                <div class="input-group">
                                                    <input type="tel" name="phone" value="<?php echo $data_update->phone; ?>" id="tel-nm" class="form-control" title="Change your Phone Number" aria-describedby="tel-nm"/>
                                                    <span class="input-group-addon" id="tel-nm"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <label for="add-nm">Address:</label>
                                                <div class="input-group">
                                                    <input type="text" name="address" value="<?php echo $data_update->address; ?>" id="add-nm" class="form-control" title="Change your Address" aria-describedby="add-nm"/>
                                                    <span class="input-group-addon" id="add-nm"><i class="fa fa-home"></i></span>
                                                </div>
                                                <label for="ct-nm">City:</label>
                                                <div class="input-group">
                                                    <input type="text" name="city" value="<?php echo $data_update->city; ?>" class="form-control" id="ct-nm" title="Change your City Name" aria-describedby="ct-nm"/>
                                                    <span class="input-group-addon" id="ct-nm"><i class="fa fa-university"></i></span>
                                                </div>
                                                <label for="sk-nm">Skype ID:</label>
                                                <div class="input-group">
                                                    <input type="text" name="skype" id="sk-nm" value="<?php echo $data_update->skype; ?>" class="form-control" title="Your Skype ID..." aria-describedby="sk-nm"/>
                                                    <span class="input-group-addon" id="sk-nm"><i class="fa fa-skype"></i></span>
                                                </div>
                                                <label for="fb-nm">Facebook Profile Link:</label>
                                                <div class="input-group">
                                                    <input type="text" name="fb" id="fb-nm" value="<?php echo $data_update->fb_url; ?>" class="form-control" title="Your Facebook Profile Link..." aria-describedby="fb-nm"/>
                                                    <span class="input-group-addon" id="fb-nm"><i class="fa fa-facebook"></i></span>
                                                </div>
                                                <label for="p-pic">Profile Picture:</label>
                                                <input type="file" name="photo" id="p-pic" value="<?php echo $data_update->prof_pic; ?>" title="Change your Profile Picture"/>
                                            </div>
                                            <section>
                                                <div>
                                                    <button type="submit" class="btn btn-success">Update Info</button>
                                                </div>
                                            </section>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-4" role="tabpanel">
                                	<div class="edit-info">
                                    	<form method="post" action="user_profile.php?user=update_password">
                                        	<div class="edit-form">
                                                <div class="input-group">
                                                    <input type="password" name="current_pw" class="form-control" placeholder="Current Password" aria-describedby="cpw"/>
                                                    <span class="input-group-addon" id="cpw"><i class="fa fa-lock" style="padding:3px"></i></span>
                                                </div>
                                                <div class="input-group">
                                                    <input type="password" name="new_pw" id="pw-new" class="form-control" placeholder="New Password" aria-describedby="new-pw" required/>
                                                    <span class="input-group-addon" id="new-pw"><i class="fa fa-key"></i></span>
                                                </div>
                                                <div class="input-group">
                                                    <input type="password" name="confirm_pw" id="pw-con" class="form-control" placeholder="Confirm New Password" aria-describedby="con-pw"/>
                                                    <span class="input-group-addon" id="con-pw"><i class="fa fa-thumbs-up"></i></span>
                                                </div>
                                            </div>
                                            <section>
                                                <div>
                                                    <button type="submit" class="btn btn-success">Save Password</button>
                                                </div>
                                            </section>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Tabs -->
                        
                    </div>
                </div>
                <!-- END Right-Column -->
                
            </div>
        </div>
        <!-- END User Profile -->
        
        <!--Start Footer-->
		<?php
            include('footer.php');
        ?>
        <!--END Footer-->
    </div>

</body>
</html>