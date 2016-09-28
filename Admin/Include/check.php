<?php 
	$connect=@mysql_connect('localhost','root','');
	mysql_select_db('admin_cat');
	
	$user_check=$_SESSION['name'];

	$ses_sql =@mysql_query("SELECT name FROM admin_login WHERE name='$user_check' ");
	
	$row=@mysql_fetch_array($ses_sql,MYSQLI_ASSOC);
	
	$login_user=$row['name'];
	
	if(!isset($user_check))
	{
	header("Location: admin_login.php");
	}
?>