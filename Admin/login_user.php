<?php
session_start();
$error='';
if( isset($_POST['submit']))
{
	if(empty($_POST['email']) || empty($_POST['password']))
	{
		echo "<script>alert('Username or Password Is Invalid');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		$connect=@mysql_connect('localhost','root','');
		$db=@mysql_select_db('bazzar');
		$email=$_POST['email'];
		$password=$_POST['password'];
		$email=stripslashes($email);
		$password=stripslashes($password);
		$query="select * from admin_login where email='$email' and password='$password'";
		$query_exe=mysql_query($query);
		$rows=@mysql_num_rows($query_exe);
		 if(mysql_num_rows($query_exe)>0)
		{
				$data=@mysql_fetch_object($query_exe);
				$_SESSION['email']=$data->email;
				$_SESSION['password']=$data->password;
				$_SESSION['name']=$data->name;
				header("location:index.php");
		}
		else
		{
			echo "<script>alert('Username or Password Is Invalid');</script>";
			echo "<script>window.location='index.php';</script>";
		}
	}
}
?>