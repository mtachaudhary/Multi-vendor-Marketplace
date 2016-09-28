<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
@include('../Include/home.php');
include('../Include/header.php');
function getBaseUrl() 
{
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	// return: http://localhost/myproject/
	return $protocol.$hostName.$pathInfo['dirname']."/";
}

function db(){
	$connect=@mysql_connect('localhost','root','');
	mysql_select_db('bazzar');
}
function db_close(){
	mysql_close($connect);
}
		if(isset($_GET['home']))
		{
			home();
		}
		
		///////////// Category Pages Function call //////////
		elseif(isset($_GET['mycat']))
		{
			if($_GET['mycat']=='add_main_cat')
			{
				add_main_cat();
			}
			
			if($_GET['mycat']=='add_cat')
			{
				add_cat();
			}
			
			if($_GET['mycat']=='add_sub_cat')
			{
				add_sub_cat();
			}
			if($_GET['mycat']=='add_brand')
			{
				add_brand();
			}
			if($_REQUEST['mycat']=='get_category')
			{
				echo "here";
				get_category();
			}
			if($_REQUEST['mycat']=='get_sub_category')
			{
				get_sub_cat();
			}
			if($_REQUEST['mycat']=='get_brand')
			{
				get_brand();
			}
			if($_GET['mycat']=='add_product')
			{
				add_products();
			}
		}
		
		///////////// Vendor Pages Function call //////////
		else if(isset($_GET['vendor']))
		{
			if($_GET['vendor']=='vendor_list')
			{
				vendor_list();
			}
			if($_GET['vendor']=='vendorship_payment')
			{
				vendorship_payment();
			}
			if($_GET['vendor']=='vendorship_type')
			{
				vendorship_type();
			}
		}
		
		///////////// Sales Pages Function call //////////
		elseif(isset($_GET['sales']))
		{
			if($_GET['sales']=='sales_report')
			{
				sales();
			}
		}
		
		///////////// Customers Pages Function call //////////
		elseif(isset($_GET['customers']))
		{
			if($_GET['customers']=='detail')
			{
				customers();
			}
		}
		
		///////////// Create_New_Page Pages Function call //////////
		elseif(isset($_GET['create_page']))
		{
			if($_GET['create_page']=='new')
			{
				create_page();
			}
		}
		
		///////////// Messaging Pages Function call //////////
		elseif(isset($_GET['messaging']))
		{
			if($_GET['messaging']=='newsletter')
			{
				newsletter();
			}
			if($_GET['messaging']=='contact_messages')
			{
				contact_messages();
			}
		}
		
		///////////// Front Setting Pages Function call //////////
		elseif(isset($_GET['front_setting']))
		{
			if($_GET['front_setting']=='banner_setting')
			{
				banner_setting();
			}
			if($_GET['front_setting']=='site_setting')
			{
				manage_site();
			}
		}
		
		///////////// Staff Pages Function call //////////
		elseif(isset($_GET['staff']))
		{
			if($_GET['staff']=='all_staff')
			{
				all_staff();
			}
			if($_GET['staff']=='staff_permission')
			{
				staff_permission();
			}
		}
		
		///////////// Bussiness Setting Pages Function call //////////
		elseif(isset($_GET['bussiness_setting']))
		{
			if($_GET['bussiness_setting']=='detail')
			{
				bussiness_setting();
			}
		}
		
		///////////// Manage Admin Profile Pages Function call //////////
		elseif(isset($_GET['admin_profile']))
		{
			if($_GET['admin_profile']=='edit')
			{
				admin_profile();
			}
		}
		
		elseif(isset($_GET['pages']))
		{
			if($_GET['pages']=='logout')
			{
				logout();
			}
		}
		
function logout()
{
		session_destroy();
		header("location:admin_login.php");
	}

function redirect($x)
{
	echo "<script>window.location.href='index.php?$x'</script>";
}
///////////////////////////////////////////////////////// Category Pages //////////////////////////////////////////////////////////////

////////////////////////////////////////////////////// Add Category Page Function /////////////////////////////////////////////////////

//------------------------------------------------Inserting Main Category Start-------------------------------------------//
if(isset($_GET['add_main_cat']) && $_GET['add_main_cat']=='ok')
{
	if(isset($_POST['add_main_cat']))
	{
		db();
		$add_main_cat=$_POST["add_main_cat"];
		$query="insert into main_category(main_cat_name) value('$add_main_cat')";
		$query_exe=@mysql_query($query);
		if($query_exe)
		{
			echo "Mubarak Ho";
		}
		else
		{
			echo "some error found".mysql_error();
		}
		
	}
}
//------------------------------------------------Inserting Main Category End-------------------------------------------//
function add_main_cat()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Categories</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Add Main Category
                        </button>
                    </div>
                    <!------------------------- Add Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="mymodal" class="modal fade">
                        	<div class="modal-dialog"> 
                                                    <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Main Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_main_cat=ok','cat_form','?mycat=add_main_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Main Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_main_cat" placeholder="Add Main Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Option</th>
                       	</tr>
                       </thead>
                       <tbody>
                       		<?php 
                       			db();
                                if(isset($_GET['mycat']) && $_GET['mycat']=='add_main_cat')
                                {
									$q="select * from main_category";
									$q_e=mysql_query($q);
									$i=1;
									while($data=mysql_fetch_assoc($q_e))
									{
										echo "<tr>";
										?>
										<td>
											<?php echo $i++; ?>
										</td>
										<td>
											<?php echo $data['main_cat_name']; ?>
										</td>
										<td class="cat-btn">
                                        	<button class="btn btn-danger btn-xs btn-delete pull-right"><i class="icon-trash"></i> Delete</button>
                                            <button class="btn btn-primary btn-xs btn-edit pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="icon-wrench"></i> Edit</button>
										</td>
										<?php
										echo "</tr>";
									}
                            	}
                            ?>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------Inserting Category Start-------------------------------------------//
if(isset($_GET['add_cat']) && $_GET['add_cat']=='ok')
{
	if(isset($_POST['add_cat']))
	{
		db();
		$main_cat=$_POST["main_cat"];
		$add_cat=$_POST["add_cat"];
		$query="insert into category(main_cat_id,cat_name) values('$main_cat','$add_cat')";
		$query_exe=@mysql_query($query);
		if($query_exe)
		{
			echo "Mubarak Ho";
		}
		else
		{
			echo "some error found".mysql_error();
		}
		
	}
}
//------------------------------------------------Inserting Category End-------------------------------------------//
function add_cat()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Categories</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Add Category
                        </button>
                    </div>
                    <!------------------------- Add Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="mymodal" class="modal fade">
                        	<div class="modal-dialog"> 
                                                    <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Main Category</label>
                                                <div class="col-sm-8">
                                                    <select name="main_cat" class="form-control">
                                                    <option disabled selected value> -- Select an Option -- </option>
                                                    <?php get_main_category(); ?>
                                                    </select>
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Option</th>
                       	</tr>
                       </thead>
                       <tbody>
                       		<?php 
                       			db();
                                if(isset($_GET['mycat']) && $_GET['mycat']=='add_cat')
                                {
									$q="select * from category";
									$q_e=mysql_query($q);
									$i=1;
									while($data=mysql_fetch_assoc($q_e))
									{
										echo "<tr>";
										?>
										<td>
											<?php echo $i++; ?>
										</td>
										<td>
											<?php echo $data['cat_name']; ?>
										</td>
										<td class="cat-btn">
                                        	<button class="btn btn-danger btn-xs btn-delete pull-right"><i class="icon-trash"></i> Delete</button>
                                            <button class="btn btn-primary btn-xs btn-edit pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="icon-wrench"></i> Edit</button>
										</td>
										<?php
										echo "</tr>";
									}
                            	}
                            ?>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////Sub Category Page Function///////////////////////////////////////////////////////

//------------------------------------------------Inserting Sub Category Start-------------------------------------------//
if(isset($_GET['add_sub_cat']) && $_GET['add_sub_cat']=='ok')
{
	db();
	if(isset($_POST['category']))
	{
		$main_cat=$_POST['main_cat'];
		$category=$_POST['category'];
		$add_sub_cat=$_POST['add_sub_cat'];
		$query="insert into sub_category (main_cat_id,cat_id,sub_cat_name) values('$main_cat','$category','$add_sub_cat')";
		//echo $query;
		$query_exe=mysql_query($query);
		if($query_exe)
		{
			echo 'Mubarak Ho Wae';
		}
		else
		{
			echo 'Some Error Found'.mysql_error();
		}
		
	}
}
//------------------------------------------------Inserting Sub Category End-------------------------------------------//
function add_sub_cat()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Sub Categories</h1>
            </div>
            <div class="panel">
                <div class="cat-content panel-body">
                    <div class="add-content">
                    	<button data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled"><i class="icon-plus"></i>  Add Sub Category</button>
                    </div>
                    <!------------------------- Sub Category Modal Starts ---------------------------->
                    <div class="modal1" id="modal_cat">
                    	<div id="mymodal" class="modal fade">
                        	<div class="modal-dialog"> 
                                                    <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Sub category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="sub_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_sub_cat=ok','sub_cat_form','?mycat=add_sub_cat')">
                                           <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Main Category</label>
                                                <div class="col-sm-8">
                                                    <select name="main_cat" class="form-control" onChange="get_option(this.value,'get_category','main_cat_id','cat');">
                                                    <option disabled selected value> -- Select an Option -- </option>
                                                    <?php get_main_category(); ?>
                                                    </select>
                                                 </div>
                                            </div>
                                           <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Category</label>
                                                <div class="col-sm-8">
                                                    <select name="category" id="cat" class="form-control">
                                                    <option disabled selected value> -- Select an Option -- </option>
                                                    <?php get_category(); ?>
                                                    </select>
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Sub Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" name="add_sub_cat" type="text" placeholder="Add Sub-Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                	<!---------------------------------- Modal Ends ---------------------------------->
                	<div class="show-content">
                    
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Option</th>
                            </thead>
                            <tbody>
                                <?php 
                                    db();
                                    if(isset($_GET['mycat']) && $_GET['mycat']=='add_sub_cat')
                                    {
                                        $q="select * from sub_category";
                                        $q_e=mysql_query($q);
                                        $i=1;
                                        while($data=mysql_fetch_assoc($q_e))
                                        {
                                            echo "<tr>";
                                            ?>
                                            <td>
                                                <?php echo $i++; ?>
                                            </td>
                                            <td>
                                                <?php echo $data['sub_cat_name']; ?>
                                            </td>
                                            <td class="cat-btn">
                                                <button class="btn btn-danger btn-xs pull-right"><i class="icon-trash"></i> Delete</button>
                                                <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#edit_sub_cat_modal" style="margin-right:4px"><i class="icon-wrench"></i> Edit</button>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                   <!------------------------- Sub Category Modal Starts ---------------------------->
                    <div class="modal1" id="modal_cat">
                    	<div id="edit_sub_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                                    <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Sub category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="sub_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_sub_cat=ok','sub_cat_form','?mycat=add_sub_cat')">
                                           <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Category</label>
                                                <div class="col-sm-8">
                                                    <select name="category" class="form-control">
                                                    <option disabled selected value> -- Select an Option -- </option>
                                                    <?php get_category(); ?>
                                                    </select>
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Sub Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" name="add_sub_cat" type="text" placeholder="Add Sub-Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                	<!---------------------------------- Modal Ends ---------------------------------->
                        
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
////////////////////////////////////////////////////Brand Page Function/////////////////////////////////////////////////////////

//------------------------------------------------Inserting Brand Start-------------------------------------------//
if(isset($_GET['add_brand']) && $_GET['add_brand']=='ok')
{
	db();
	if(isset($_POST['category']))
	{
		$main_cat=$_POST['main_cat'];
		$category=$_POST['category'];
		$add_sub_cat=$_POST['sub_cat'];
		$add_brand=$_POST['add_brand'];
		$query="insert into brand (main_cat_id,cat_id,sub_cat_id,brand_name) values('$main_cat','$category','$add_sub_cat','$add_brand')";
		echo $query;
		$query_exe=mysql_query($query);
		if($query_exe)
		{
			echo 'Mubarak Ho Wae';
		}
		else
		{
			echo 'Some Error Found'.mysql_error();
		}
		
	}
}
//------------------------------------------------Inserting Brand End-------------------------------------------//

function add_brand()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Brands</h1>
            </div>
            <div class="panel">
                <div class="cat-content panel-body">
                    <div class="add-content">
                    	<button data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled"><i class="icon-plus"></i>  Add Brand</button>
                    </div>
                <!------------------------- Add Brands Modal Starts ---------------------------->
                    <div class="modal1">
                        <div id="mymodal" class="modal fade">
                            <div class="modal-dialog"> 
                             <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Brand</h4>
                                </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="" id="brand_form" onSubmit="return form_submit('Pages/function.php?add_brand=ok','brand_form','?mycat=add_brand')">
                                	 <div class="form-group">
                                     	<label class="col-sm-4 control-label">Select Main Category</label>
                                     	<div class="col-sm-8">
                                     		<select name="main_cat" class="form-control" onChange="get_option(this.value,'get_category','main_cat_id','cat');">
                                     			<option disabled selected value> -- Select an Option -- </option>
                                     			<?php get_main_category(); ?>
                                     		</select>
                                     	</div>
                                     </div>
                                     <div class="form-group">
                                     	<label class="col-sm-4 control-label">Select Category</label>
                                     	<div class="col-sm-8">
                                     		<select name="category" id="cat" class="form-control" onChange="get_option(this.value,'get_sub_category','cat_id','sub_cat');">
                                     			<option disabled selected value> -- Select an Option -- </option>
                                      			<?php get_category(); ?>
                                      		</select>
                                      	</div>
                                      </div>
                                    	<div class="form-group">
                                    		<label class="col-sm-4 control-label">Select Sub Category</label>
                                        	<div class="col-sm-8">
                                            	<select name="sub_cat" id="sub_cat" class="form-control">
                                            	<?php get_sub_cat(); ?>
                                            	</select>
                                        	</div>
                                    	</div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Brand Name</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="add_brand" type="text" placeholder="Add Category" />
                                            </div>
                                        </div>
                                        <div class="form-group modal-btn">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        </div>
                                </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <!------------------------- Modal Ends ---------------------------->
                    <div class="show-content">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Option</th>
                            </thead>
                            <tbody>
								<?php 
									db();
									if(isset($_GET['mycat']) && $_GET['mycat']=='add_brand')
									{
										$q="select * from brand";
										$q_e=mysql_query($q);
										$i=1;
										while($data=mysql_fetch_assoc($q_e))
										{
											echo "<tr>";
											?>
											<td>
												<?php echo $i++; ?>
                                            </td>
											<td>
												<?php echo $data['brand_name']; ?>
                                            </td>
											<td class="cat-btn">
                                                <button class="btn btn-danger btn-xs pull-right"><i class="icon-trash"></i> Delete</button>
                                                <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#edit_brand_modal" style="margin-right:4px"><i class="icon-wrench"></i> Edit</button>
											</td>
											<?php
											echo "</tr>";
										}
									}
                                ?>
                            </tbody>
                        </table>
                        <!------------------------- Edit Brands Modal Starts ---------------------------->
                        <div class="modal1">
                        <div id="edit_brand_modal" class="modal fade">
                            <div class="modal-dialog"> 
                             <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add Brand</h4>
                                </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" action="" id="brand_form" onSubmit="return form_submit('Pages/function.php?add_brand=ok','brand_form','?mycat=add_brand')">
                                    <div class="form-group">
                                    	<label class="col-sm-4 control-label">Select Category</label>
                                        <div class="col-sm-8">
                                            <select name="category" class="form-control" onBlur="get_option(this.value,'get_sub_category','cat_id','sub_cat');">
                                            	<option disabled selected value> -- Select an Option -- </option>
                                            	<?php get_category(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="col-sm-4 control-label">Select Sub Category</label>
                                        <div class="col-sm-8">
                                            <select name="sub_cat" id="sub_cat" class="form-control">
                                            	<?php get_sub_cat(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Brand Name</label>
                                        <div class="col-sm-8">
                                        	<input class="form-control" name="add_brand" type="text" placeholder="Add Category" />
                                        </div>
                                    </div>
                                    <div class="form-group modal-btn">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    	<!------------------------- Modal Ends ---------------------------->
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

////////////////////////////////////////////////////Products Page Function//////////////////////////////////////////////////////////

//------------------------------------------------Inserting Product Start-------------------------------------------//
if(isset($_GET['add_product']) && $_GET['add_product']=='ok')
{
	echo"<script>alert('hy');</script>";
	db();
	if(isset($_POST['category']))
	{
		$main_cat=$_POST['main_cat'];
		$category=$_POST['category'];
		$add_sub_cat=$_POST['sub_cat'];
		$add_brand=$_POST['add_brand'];
		$add_product=$_POST['product_name'];
		$query="insert into product (main_cat_id, cat_id, sub_cat_id, brand_id, product_name) values('$main_cat','$category','$add_sub_cat','$add_brand','$add_product')";
		echo $query;
		$query_exe=mysql_query($query);
		if($query_exe)
		{
			echo 'Mubarak Ho Wae';
		}
		else
		{
			echo 'Some Error Found'.mysql_error();
		}
	}
}
//------------------------------------------------Inserting Product End-------------------------------------------//
function add_products()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Products</h1>
            </div>
            <div class="panel">
                <div class="cat-content panel-body">
                    <div class="add-content">
                    	<button data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled"><i class="icon-plus"></i>  Add Products</button>
                    </div>
                <!------------------------- Modal Starts ---------------------------->
                    <div class="modal1">
                        <div id="mymodal" class="modal fade">
                            <div class="modal-dialog modal-lg"> 
                            <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Product</h4>
                                    </div>
                                    <div class="modal-body">
                                    	<form method="post" class="form-horizontal form-manage-detail" id="add_prod" onSubmit="return form_submit('Pages/function.php?add_product=ok','product_form','?mycat=add_product')" enctype="multipart/form-data">
                                        <div class="row">
                                        	<div class="col-sm-6">
                                				<fieldset>
                                                    <legend>Product Details</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="p_title">Product Title</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" name="p_title" class="form-control" id="p_title" placeholder="Product Title"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5">Main Category</label>
                                                        <div class="col-sm-7">
                                                            <select name="main_cat" class="form-control" onChange="get_option(this.value,'get_category','main_cat_id','cat');">
                                                                <option disabled selected>-- Select an Option --</option>
                                                                <?php get_main_category(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5">Category</label>
                                                        <div class="col-sm-7">
                                                            <select name="category" id="cat" class="form-control" onChange="get_option(this.value,'get_sub_category','cat_id','sub_cat');">
                                                                <option disabled selected>-- Select an Option --</option>
                                                                <?php get_category(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5">Sub Category</label>
                                                        <div class="col-sm-7">
                                                            <select name="sub_cat" id="sub_cat" class="form-control" onChange="get_option(this.value,'get_brand','sub_cat_id','get_brand');">
                                                                <option disabled selected>-- Select an Option --</option>
                                                                <?php get_sub_cat(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5">Brand</label>
                                                        <div class="col-sm-7">
                                                            <select name="add_brand" id="get_brand" class="form-control">
                                                                <option disabled selected>-- Select an Option --</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="unit">Unit</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Unit (e.g. Kg, Pc etc.)"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="qty">Quantity</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" name="quantity" class="form-control" id="qty" placeholder="Current Quantity"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="photo">Select Photo</label>
                                                        <div class="col-sm-7">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <label class="btn btn-info btn-file" for="multiple_input_group">
                                                                        <div class="input required">
                                                                            <input type="file" name="prod_img" id="multiple_input_group" class="form-control" multiple/>
                                                                        </div> 
                                                                        Browse
                                                                    </label>
                                                                </span>
                                                                <span class="file-input-label" for="multiple_input_group">No file selected.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="desc">Description</label>
                                                        <div class="col-sm-7">
                                                            <textarea type="text" name="desc" class="form-control" id="desc" style="resize:vertical; min-height:110px;"></textarea>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-sm-6">
                                            	<fieldset>
                                                    <legend>Business Details</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="sale-price">Sale Price</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" step="0.01" name="sale-price" class="form-control" id="sale-price" placeholder="Sale Price ($)"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="Purchase">Purchase Price</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" step="0.01" name="purch-price" class="form-control" id="Purchase" placeholder="Purchase Price ($)"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="shipping">Shipping Cost</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" step="0.01" name="shipping" class="form-control" id="shipping" placeholder="Shipping Cost ($)"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="prod-tax">Product Tax</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" step="0.01" name="prod-tax" class="form-control" id="prod-tax" placeholder="Product Tax (%)"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="prod-disc">Product Discount</label>
                                                        <div class="col-sm-7">
                                                            <input type="number" min="0" step="0.01" name="prod-disc" class="form-control" id="prod-disc" placeholder="Product Discount (%)"/>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Customer Choice</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-5" for="prod-color">Product Color</label>
                                                        <div class="col-sm-7">
                                                            <input type="color" name="prod-color" class="form-control" id="prod-color" placeholder="Product Discount (%)"/>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!------------------------- Modal Ends ---------------------------->
                    <div class="show-content">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Current Quantity</th>
                                <th>Publish</th>
                                <th>Option</th>
                            </thead>
                            <tbody>
                                <?php 
                                    db();
                                    if(isset($_GET['mycat']) && $_GET['mycat']=='add_product')
                                    {
                                        $q="select * from product";
                                        $q_e=mysql_query($q);
                                        $i=1;
                                        while($data=mysql_fetch_assoc($q_e))
                                        {
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $i++; ?></td>
                                            <td></td>
                                            <td><?php echo $data['product_name']; ?></td>
                                            <td><?php echo $data['quantity']; ?></td>
                                            <td></td>
                                            <td class="cat-btn">
                                                <button class="btn btn-danger btn-xs pull-right"><i class="icon-trash"></i> Delete</button>
                                                <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#edit_product_modal" style="margin-right:4px"><i class="icon-wrench"></i> Edit</button>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!------------------------- Edit Products Modal Starts ---------------------------->
                        <div class="modal1">
                        <div id="edit_product_modal" class="modal fade">
                            <div class="modal-dialog"> 
                            <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Product</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="" id="product_form" onSubmit="return form_submit('Pages/function.php?add_product=ok','product_form','?mycat=add_product')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Category</label>
                                                <div class="col-sm-8">
                                                    <select name="category" class="form-control" onBlur="get_option(this.value,'get_sub_category','cat_id','get_sub_category');">
                                                    <?php get_category(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Sub Category</label>
                                                <div class="col-sm-8">
                                                    <select name="sub_cat" id="get_sub_category" class="form-control" onBlur="get_option(this.value,'get_brand','sub_cat_id','get_brand')">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Brand</label>
                                                <div class="col-sm-8">
                                                    <select name="add_brand" id="get_brand" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Product Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" name="product_name" type="text" placeholder="Add Category" />
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-sm-4 control-label">Unit</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" name="unit_name" type="text" placeholder="Unit" />
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-sm-4 control-label">Quantity</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" name="quantity_name" type="text" placeholder="Quantity" />
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-sm-4 control-label">Select Photo</label>
                                                <div class="col-sm-8">
                                                	<input name="photo_name" type="file"/>
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-sm-4 control-label">Product Detail</label>
                                                <div class="col-sm-8">
                                                	<textarea></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    	<!------------------------- Modal Ends ---------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
////////////////////////////////////////////////////// Category Pages End Here //////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Vendor Pages Starts //////////////////////////////////////////////////////

//------------------------------------------------Vendor_list Page Fucction-------------------------------------------//
function vendor_list()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Vendors</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Add Category
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>#</th>
                            <th>Display Name</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Option</th>
                       	</tr>
                       </thead>
                       	<tbody>
                        	<?php 
                       			db();
                                if(isset($_GET['vendor']) && $_GET['vendor']=='vendor_list')
                                {
									$q="select * from register_vendor";
									$q_e=mysql_query($q);
									$i=1;
									while($data=mysql_fetch_assoc($q_e))
									{
										echo "<tr>";
										?>
										<td>
											<?php echo $i++; ?>
										</td>
										<td>
											<?php echo $data['business_name']; ?>
										</td>
                                        <td>
											<?php echo $data['f_name']; ?>
										</td>
                                        <td>
											<?php echo $data['status']; ?>
										</td>
                                         <td class="cat-btn">
                                            <button class="btn btn-danger btn-xs btn-labeled pull-right"> <i class="icon-trash"></i> Delete</button>
                                            <button class="btn btn-info btn-xs btn-labeled pull-right" style="margin-right:4px"> <i class="fa fa-usd"></i>  Pay</button>
                                            <a href="Pages/function.php?vendor&update=<?php echo $data['status'] ?>"><button class="btn btn-success btn-xs pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="fa fa-check"></i> Approve</button></a>
                                           <a href="Pages/function.php?vendor&update=<?php echo $data['status'] ?>"><button class="btn btn-default btn-xs pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="icon-eye-close"></i> Disapprove</button></a>
                                            <button class="btn btn-black btn-xs btn-labeled pull-right" style="margin-right:4px; background:black; color:white"><i class="fa fa-user"></i>  Profile</button>
                                        </td>
										<?php
										echo "</tr>";
									}
                            	}
                            ?>
                            <?php
								if(isset($_GET['vendor']))
								{
									if(isset($_GET['update']))
									{
										db();
										$status = $_GET['update'];
										echo $status;
										$qry = "UPDATE register_vendor
												SET status='approve' WHERE status='$status'";
										$result=mysql_query($qry);
										if($result)
										{
											echo "success";
										}
										else
										{
											echo mysql_error();
										}
									}
								}
							 ?>
                            
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------Vendorship_payment Page Fucction-------------------------------------------//
function vendorship_payment()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Vendorship Payments</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Add Category
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>Logo</th>
                            <th>Vendor</th>
                            <th>Amount</th>
                            <th>Upgraded Vendorship</th>
                            <th>Status</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-info btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-check"></i>  Check Details</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------Vendorship_type Page Fucction-------------------------------------------//
function vendorship_type()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Vendorship Types</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Vendorship
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Seal</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>For</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-wrench"></i>  Edit</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Vendor Pages Ends //////////////////////////////////////////////////////

///////////////////////////////////////////////////// Sales Report Pages Starts //////////////////////////////////////////////////////

function sales()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Sales</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Add Category
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>ID</th>
                            <th>Sale Code</th>
                            <th>Buyer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Delivery Status</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="fa fa-trash"></i> Delete</button>
                                    <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-usd"></i> Delivery Status</button>
                                    <button class="btn btn-info btn-xs pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="fa fa-file-text-o"></i> Full Invoice</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Sales Report Pages Ends //////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Customers Pages Starts //////////////////////////////////////////////////////

function customers()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Users</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Vendorship
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Total Purchase</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px; background:rgba(0,144,106,1.00);"><i class="fa fa-magic"></i>  Profile</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Customers Pages Ends //////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Create_New_page Starts //////////////////////////////////////////////////////

function create_page()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Page</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Page
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Page Name</th>
                            <th>Publish</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Create_New_Page Ends //////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Messaging Page Starts //////////////////////////////////////////////////////

//------------------------------------------------News Letter Page Fucction-------------------------------------------//
function newsletter()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Send Newsletter</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------Contact Messages Page Fucction-------------------------------------------//
function contact_messages()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Contact Messages</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Vendorship
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Total Purchase</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-info btn-xs btn-labeled pull-right" style="margin-right:4px;"><i class="fa fa-magic"></i>  View Message</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Messaging Page Ends //////////////////////////////////////////////////////

/////////////////////////////////////////////////// Front Setting Pages Starts //////////////////////////////////////////////////////

//------------------------------------------------News Letter Page Fucction-------------------------------------------//
function banner_setting()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Banners</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------News Letter Page Fucction-------------------------------------------//
function manage_site()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Site</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

/////////////////////////////////////////////////////// Front Setting Pages Ends ////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Staff Pages Starts //////////////////////////////////////////////////////

//------------------------------------------------All Staff Page Fucction-------------------------------------------//
function all_staff()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Staffs</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Admin
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-wrench"></i>  Edit</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------Staff Permission Page Fucction-------------------------------------------//
function staff_permission()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Roles</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="icon-plus"></i>  Create Role
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Options</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="icon-trash"></i> Delete</button>
                                    <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-wrench"></i>  Edit</button>
                                </td>										
                            </tr>
                   		</tbody>
                   </table>
                   <!------------------------- Edit Category Modal Starts ---------------------------->
                	<div class="modal1" id="modal_cat">
                    	<div id="edit_cat_modal" class="modal fade">
                        	<div class="modal-dialog"> 
                                <!-- Modal content-->
                             	<div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?add_cat=ok','cat_form','?mycat=add_cat')">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category Name</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control" type="text" name="add_cat" placeholder="Add Category" />
                                                </div>
                                            </div>
                                            <div class="form-group modal-btn">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </div>
                   	<!------------------------------- Modal Ends ------------------------------------->
                   </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Staff Pages Ends //////////////////////////////////////////////////////

///////////////////////////////////////////////////////// Bussiness Setting Page Starts ////////////////////////////////////////////

function bussiness_setting()
{?>

<script>
$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  
    
    if ($(this).find('.btn-primary').size()>0)
	{
    	$(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) 
	{
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) 
	{
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) 
	{
    	$(this).find('.btn').toggleClass('btn-info');
    }
    
    $(this).find('.btn').toggleClass('btn-default');
       
});
</script>


<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Bussiness Settings</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                	<div class="btn-group btn-toggle"> 
                        <button class="btn btn-success btn-xs">ON</button>
                        <button class="btn btn-danger btn-xs active">OFF</button>
                    </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////// BUssiness Setting Page Ends //////////////////////////////////////////////////////

/////////////////////////////////////////////////// Admin Profile Page Starts //////////////////////////////////////////////////////

function admin_profile()
{?>
<!------------------------------------------------File Upload Script------------------------------------------------>
<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		console.log("teste");
		var input_label = $(this).closest('.input-group').find('.file-input-label'),
			log = numFiles > 1 ? numFiles + ' files selected' : label;

		if( input_label.length ) {
			input_label.text(log);
		} else {
			if( log )
			{
				alert(log);
			}
		}
	});
});
</script>
<!------------------------------------------------File Upload Script------------------------------------------------>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Profile</h1>
            </div>
            <div class="tab-base">
                <div class="panel">
                    <div class="panel-body cat-content">
                    	<ul class="nav nav-pills nav-justified">
                          <li class="active"><a data-toggle="pill" href="#manage_detail">Manage Details</a></li>
                          <li><a data-toggle="pill" href="#manage_pass">Manage Password</a></li>
                        </ul>
                        <div class="tab-content">
<!-------------------------------------------------Update Proile Form Starts------------------------------------------------->
                            <div id="manage_detail" class="tab-pane fade in active">
                            	<h3>Manage Details</h3>
                            	<div class="">
                                	<form method="post" action="" class="form-horizontal form-manage-detail">
                                    	<div class="form-group">
                                        	<label class="control-label col-sm-2" for="name">Name</label>
                                            <div class="col-sm-10">
                                            	<input type="text" name="name" class="form-control input-lg" placeholder="Your Name" id="name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="control-label col-sm-2" for="email">E-mail</label>
                                            <div class="col-sm-10">
                                            	<input type="email" name="email" class="form-control input-lg" placeholder="Your E-mail" id="email" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                        	<label class="control-label col-sm-2" for="photo">Select Photo</label>
                                            <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <label class="btn btn-info btn-lg btn-file" for="multiple_input_group">
                                                        <div class="input required"><input id="multiple_input_group" class="input-lg form-control" type="file" multiple>
                                                        </div> 
                                                        Browse
                                                    </label>
                                                </span>
                                                <span class="file-input-label"></span>
                                            </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                        	<label class="control-label col-sm-2" for="phone">Phone</label>
                                            <div class="col-sm-10">
                                            	<input type="tel" name="phone" class="form-control input-lg" placeholder="Phone Number" id="phone" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="control-label col-sm-2" for="sddress">Address</label>
                                            <div class="col-sm-10">
                                            	<input type="text" name="address" class="form-control input-lg" placeholder="Your Address" id="address" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                        	<button type="submit" name="submit" class="btn btn-info pull-right"><i class="fa fa-refresh"></i>Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
<!--------------------------------------------------Update Proile Form Ends-------------------------------------------------->


<!------------------------------------------------Change Password Form Starts------------------------------------------------>
                            <div id="manage_pass" class="tab-pane fade">
                                <h3>Change Password</h3>
                                <form method="post" action="" class="form-horizontal form-manage-detail">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="current-pwd">Current Password</label>
                                        <div class="col-sm-9">
                                        	<input type="password" name="password" class="form-control input-lg" placeholder="Current Password" id="current-pwd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="new-pwd">New Password *</label>
                                        <div class="col-sm-9">
                                        	<input type="password" name="npassword" class="form-control input-lg" placeholder="Your E-mail" id="new-pwd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="confirm-pwd">Confirm Password</label>
                                        	<div class="col-sm-9">
                                        <input type="password" name="cpassword" class="form-control input-lg" placeholder="Phone Number" id="confirm-pwd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<button type="submit" name="submit" class="btn btn-info pull-right"><i class="fa fa-refresh"></i>Update Password</button>
                                    </div>
                            	</form>
                            </div>
<!------------------------------------------------Change Password Form Ends------------------------------------------------>
                    	</div>  
                    </div>
                </div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Admin Profile Page Ends //////////////////////////////////////////////////////

///////////////////////////////////////////// Get Category Logic /////////////////////////////////////////////////////////////////

function get_main_category()
{
	db();
	$q="select * from main_category";
	$q_exe=mysql_query($q);
	//echo $q;
	if($q_exe)
	{
		while($rec=mysql_fetch_array($q_exe))
		{
			echo "<option value='".$rec['id']."'>".$rec['main_cat_name']."</option>";
		}
	}
	else
	{ 
		echo mysql_error();
	}
}

///////////////////////////////////////////// Get Category Logic /////////////////////////////////////////////////////////////////

function get_category()
{
	db();
	$q="select * from category where main_cat_id='".$_GET['main_cat_id']."'";
	$q_exe=mysql_query($q);
	echo $q;
	if($q_exe)
	{
		echo"<option disabled selected>-- Select an Option --</option>";
		while($rec=mysql_fetch_array($q_exe))
		{
			echo "<option value='".$rec['id']."'>".$rec['cat_name']."</option>";
		}
		
	}
	else
	{ 
		echo mysql_error();
	}
	
}

///////////////////////////////////////////// Get Sub Category Logic /////////////////////////////////////////////////////////////////

function get_sub_cat()
{
	db();
	$q="select * from sub_category where cat_id='".$_GET['cat_id']."'";
	$q_exe=mysql_query($q);
	//echo $q;
	if($q_exe)
	{
		echo"<option disabled selected>-- Select an Option --</option>";
		while($rec=mysql_fetch_array($q_exe))
		{
				echo "<option value='".$rec['id']."'>".$rec['sub_cat_name']."</option>";
		}
		
	}
	else
	{
			echo mysql_error();
	}
	
}
	
///////////////////////////////////////////// Get Brand Category Logic/////////////////////////////////////////////////////////////////

function get_brand()
{
	db();
	$q="select * from brand where sub_cat_id='".$_GET['sub_cat_id']."'";
	$q_exe=mysql_query($q);
	//echo $q;
	if($q_exe)
	{
		echo"<option disabled selected>-- Select an Option --</option>";
		while($rec=mysql_fetch_array($q_exe))
		{
				echo "<option value='".$rec['id']."'>".$rec['brand_name']."</option>";
		}
		
	}
	else
	{
		echo mysql_error();
	}
	
}
?>
