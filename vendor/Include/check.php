<?php 
	$connect = @mysql_connect('localhost','root','');
	mysql_select_db('bazzar');
	
	$vendor_check = $_SESSION['v_email'];

	$ses_sql = @mysql_query("SELECT email FROM register_vendor WHERE email='$vendor_check'");
	
	$row = @mysql_fetch_array($ses_sql,MYSQLI_ASSOC);
	
	$login_user = $row['email'];
	
	if(!isset($vendor_check))
	{
		header("location:../login-form.php");
	}
?>