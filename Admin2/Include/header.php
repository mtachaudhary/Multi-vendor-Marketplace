<?php
function admin_header()
{?>
<div class="row">
  <div class="header_admin col-sm-12">
      <div class="bar">
        <img src="images/bars.png" alt="menu-bar" />
      </div>
      <ul class="navbar_right list-unstyled">
      	<li id="admin-info"> <a> <img src="images/admin.png" class="img-circle img-thumbnail img-responsive" alt="image"/><span><?php echo $_SESSION['name'] ?></span> <i class="fa fa-angle-down"></i> </a>
      		<ul class="dropdown-menu list-unstyled" style="display:none;">
      			<li><a href="#">Profile</a></li>
      			<li><a href="#">Setting</a></li>
      			<li><a href="#">Help</a></li>
      			<li><a href="index.php?pages=logout">Sign Out</a></li>
      		</ul>
      	</li>
      </ul>
  </div>
  </div>
<?php }

if(isset($_GET['pages']) && $_GET['pages']=='logout')
{
	session_destroy();
	header('location:admin_login.php');
}

?>