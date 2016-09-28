<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
@include('../Include/dashboard.php');
include('../Include/header.php');
?>
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
<?php

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

function db()
{
	$connect=@mysql_connect('localhost','root','');
	mysql_select_db('bazzar');
}
function db_close()
{
	mysql_close($connect);
}

///////////// Dashboard Pages Function call //////////
if(isset($_GET['dashboard']))
{
	dashboard();
}

///////////// My Products Pages Function call //////////
else if(isset($_GET['myproduct']))
{
	if($_GET['myproduct']=='product_list')
	{
		product_list();
	}
	
	if($_GET['myproduct']=='product_stock')
	{
		product_stock();
	}
	if($_GET['myproduct']=='get_category')
	{
		get_category();
	}
	if($_GET['myproduct']=='get_sub_category')
	{
		get_sub_cat();
	}
	if($_GET['myproduct']=='get_brand')
	{
		get_brand();
	}
	if(isset($_GET['delete_product']))
	{
		delete_product();
	}
}

///////////// Reports Pages Function call //////////
else if(isset($_GET['reports']))
{
	if($_GET['reports']=='product_compare')
	{
		product_compare();
	}
	if($_GET['reports']=='product_stock_report')
	{
		product_stock_report();
	}
	if($_GET['reports']=='product_wishes')
	{
		product_wishes();
	}
}

///////////// Sales Pages Function call //////////
else if(isset($_GET['sales']))
{
	if($_GET['sales']=='sales_report')
	{
		sales();
	}
}

///////////// Payment Settings Pages Function call //////////
else if(isset($_GET['payment_settings']))
{
	if($_GET['payment_settings']=='detail')
	{
		payment_settings();
	}
}

///////////// Manage Vendor Profile Pages Function call //////////
else if(isset($_GET['vendor_profile']))
{
	if($_GET['vendor_profile']=='edit')
	{
		vendor_profile();
	}
}

///////////// Logout Vendor - Dashboard //////////
else if(isset($_GET['pages']))
{
	if($_GET['pages']=='logout')
	{
		logout();
	}
}
		
function logout()
{
	session_destroy();
	header("location:../login-form.php");
}

function redirect($x)
{
	echo "<script>window.location.href='index.php?$x'</script>";
}
///////////////////////////////////////////////////// My Products Pages Starts /////////////////////////////////////////////////////

//------------------------------------------------ Product List Page Function -------------------------------------------//
if(isset($_GET['product_list']) && $_GET['product_list']=='ok')
{
	if(isset($_POST['p_title']))
	{
		db();
		$q_sel = "SELECT id FROM product";
		$q_sel_exe = mysql_query($q_sel);
		if($q_sel_exe)
		{
			$data_prod = mysql_fetch_object($q_sel_exe);
		}
		$prod_title = $_POST['p_title'];
		$main_cat = $_POST['main_cat'];
		$category = $_POST['category'];
		$add_sub_cat = $_POST['sub_cat'];
		$add_brand = $_POST['add_brand'];
		$unit = $_POST['unit'];
		$quantity = $_POST['quantity'];
		$prod_desc = $_POST['desc'];
		$sale_price = $_POST['sale-price'];
		$purch_price = $_POST['purch-price'];
		$shipping_cost = $_POST['shipping'];
		$prod_tax = $_POST['prod-tax'];
		$prod_discount = $_POST['prod-disc'];
		$prod_color = $_POST['prod-color'];
		$path = explode('.', $_FILES['prod_img']['name']);
		$extension = $path[count($path)-1];
		$product_code=$prod_title.rand()*999;
		
		$query_prod = "INSERT INTO product (main_cat_id, cat_id, sub_cat_id, brand_id, vendor_id, product_name, unit, quantity, product_description,product_image, sale_price, purchase_price, shipping_cost, product_tax, product_discount, product_color,product_code) VALUES('$main_cat','$category','$add_sub_cat','$add_brand','".$_SESSION['v_id']."','$prod_title','$unit','$quantity','$prod_desc','".$extension."','$sale_price','$purch_price','$shipping_cost','$prod_tax','$prod_discount','$prod_color','".$product_code."')";
		$query_prod_exe = @mysql_query($query_prod);
		if($query_prod_exe)
		{
			$pic_id=@mysql_insert_id();
			if(@move_uploaded_file($_FILES['prod_img']['tmp_name'],"../images/product_pics/item_pic(".$pic_id.").".$extension))
			{
				echo $extension; 
			}
		}
		else
		{
			echo "some error found".mysql_error();
		}
	}
}

function delete_product()
{
	db();
	$delprod_id = $_GET['delete_product'];
	echo $delprod_id;
	echo'<script>alert("'.$delprod_id.'");</script>';
	$q_delete = "DELETE FROM product WHERE id='$delprod_id'";
	$del_exe = mysql_query($q_delete);
	if($del_exe)
	{
		echo "success";
	}
	else
	{
		echo mysql_error();
	}
}

function product_list()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Product</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content" id="show-prod">
                    <div class="add-content">
                        <button type="button" onClick="create_product()" class="btn btn-primary btn-labeled">
                            <i class="fa fa-plus"></i>Create Product
                        </button>
                    </div>
                    <div class="show-content">
                        <table class="table table-striped table-bordered prod-list-table">
                           <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Image</th>
                                  <th>Name</th>
                                  <th>Current Quantity</th>
                                  <th>Directory</th>
                                  <th>Option</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                                <?php 
                                    db();
                                    if(isset($_GET['myproduct']) && $_GET['myproduct']=='product_list')
                                    {
                                        $q="SELECT * FROM product WHERE vendor_id='".$_SESSION['v_id']."'";
                                        $q_e=mysql_query($q);
                                        $i=1;
                                        while($data=mysql_fetch_array($q_e))
                                        {
                                            echo "<tr>";
                                            ?>
                                            <td><?php echo $i++; ?></td>
                                            <td><img src="images/product_pics/item_pic(<?php echo $data['id'] ?>).<?php echo $data['product_image']; ?>" width="150px"/></td>
                                            <td><?php echo $data['product_name']; ?></td>
                                            <td><?php echo $data['quantity']; ?></td>
                                            <td></td>
                                            <td class="cat-btn">
                                                <button class="btn btn-danger btn-xs btn-delete pull-right" onClick="confirm_model(<?php echo $data['id'] ?>)">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                                <button class="btn btn-primary btn-xs btn-edit pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px">
                                                    <i class="fa fa-wrench"></i> Edit
                                                </button>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        }
                                        if(!mysql_num_rows($q_e)>0)
                                        {?>
                                            <tr class="text-center">
                                                <td colspan="8">No matching records found</td>
                                            </tr>
                                        <?php
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
                                            <form class="form-horizontal" method="post" id="edit_cat_form" onSubmit="return form_submit('Pages/function.php?product_list=ok','edit_cat_form','?myproduct=product_list')">
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
                
                <!------------------------- Delete Modal Starts ---------------------------->
                <div class="modal fade" id="modal-4">
                    <div class="modal-dialog">
                        <div class="modal-content" style="margin-top:100px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                            </div>
                            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                                <a style="cursor:pointer;" class="btn btn-danger">Delete</a>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------------------- Delete Modal ENDs ---------------------------->
                
                <!--Create Product Panel-body Start-->
                <div class="panel-body cat-content" id="create-prod" style="display:none">
                	<div class="add-content">
                        <button type="button" onClick="back_to_product()" class="btn btn-primary btn-labeled">
                            <i class="fa fa-step-backward"></i>Back To Product List
                        </button>
                    </div>
                    <div class="show-content">
                    	<ul class="nav nav-pills nav-justified">
                            <li class="active"><a data-toggle="pill" href="#prod_detail">Create Product</a></li>
                            <li><a data-toggle="pill" href="#req_cat">Request Category</a></li>
                        </ul>
                        <div class="tab-content">
                        	<div id="prod_detail" class="tab-pane fade in active"><br>
                            	<form method="post" class="form-horizontal form-manage-detail" id="add_prod" onSubmit="return form_submit('Pages/function.php?product_list=ok','add_prod','?myproduct=product_list')" enctype="multipart/form-data">
                                	<fieldset>
                                    	<legend>Product Details</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="p_title">Product Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="p_title" class="form-control" id="p_title" placeholder="Product Title"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Main Category</label>
                                            <div class="col-sm-6">
                                                <select name="main_cat" class="form-control" onChange="get_option(this.value,'get_category','main_cat_id','cat');">
                                                    <option disabled selected>-- Select an Option --</option>
                                                    <?php get_main_category(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Category</label>
                                            <div class="col-sm-6">
                                                <select name="category" id="cat" class="form-control" onChange="get_option(this.value,'get_sub_category','cat_id','sub_cat');">
                                                    <option disabled selected>-- Select an Option --</option>
                                                    <?php get_category(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Sub Category</label>
                                            <div class="col-sm-6">
                                                <select name="sub_cat" id="sub_cat" class="form-control" onChange="get_option(this.value,'get_brand','sub_cat_id','get_brand');">
                                                    <option disabled selected>-- Select an Option --</option>
                                                    <?php get_sub_cat(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Brand</label>
                                            <div class="col-sm-6">
                                                <select name="add_brand" id="get_brand" class="form-control">
                                                    <option disabled selected>-- Select an Option --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="unit">Unit</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="unit" class="form-control" id="unit" placeholder="Unit (e.g. Kg, Pc etc.)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="qty">Quantity</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" name="quantity" class="form-control" id="qty" placeholder="Current Quantity"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="photo">Select Photo</label>
                                            <div class="col-sm-6">
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
                                            <label class="control-label col-sm-3" for="desc">Description</label>
                                            <div class="col-sm-6">
                                                <textarea type="text" name="desc" class="form-control" id="desc" style="resize:vertical; min-height:110px;"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    	<legend>Business Details</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="sale-price">Sale Price</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="0.01" name="sale-price" class="form-control" id="sale-price" placeholder="Sale Price ($)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="Purchase">Purchase Price</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="0.01" name="purch-price" class="form-control" id="Purchase" placeholder="Purchase Price ($)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="shipping">Shipping Cost</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="0.01" name="shipping" class="form-control" id="shipping" placeholder="Shipping Cost ($)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="prod-tax">Product Tax</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="0.01" name="prod-tax" class="form-control" id="prod-tax" placeholder="Product Tax (%)"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="prod-disc">Product Discount</label>
                                            <div class="col-sm-6">
                                                <input type="number" min="0" step="0.01" name="prod-disc" class="form-control" id="prod-disc" placeholder="Product Discount (%)"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                    	<legend>Customer Choice</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="prod-color">Product Color</label>
                                            <div class="col-sm-6">
                                                <input type="color" name="prod-color" class="form-control" id="prod-color" placeholder="Product Discount (%)"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group text-right">
                                    	<button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div id="req_cat" class="tab-pane fade">
                                <h3>Request New Category</h3>
                                <form method="post" class="form-horizontal form-manage-detail" action="Pages/function.php?request=request_category" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="new-cat">New Category/Sub-category</label>
                                        <div class="col-sm-6">
                                            <textarea type="text" name="req-cat" class="form-control" id="new-cat" style="resize:vertical; min-height:110px;"></textarea>
                                        </div>
                                    </div>
                                    <strong style="float:left; margin-right:5px; color:#5bc0de;">Note:</strong><p style="color:rgb(155,155,155);">Define your new main-category/category/sub-category. Want to request sub-category? Indicate main-category/category before requested sub-category. (e.g. Main-category > Category >> Requested sub-category)</p>
                                    <div class="form-group text-right">
                                        <div class="col-sm-6 col-sm-offset-4">
                                            <button type="submit" class="btn btn-primary nomargin">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Create Product Panel-body End-->
        	</div>
        </div>
    </div>
</div>
<?php
}

//------------------------------------------------ Product Stock Page Function -------------------------------------------//
if(isset($_GET['product_stock']) && $_GET['product_stock']=='ok')
{
	if(isset($_POST['category']))
	{
		db();
		$category=$_POST['category'];
		$add_sub_cat=$_POST['add_sub_cat'];
		$query="insert into sub_category (cat_id,sub_cat_name) values('$category','$add_sub_cat')";
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

function product_stock()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Your Product Stock</h1>
            </div>
            <div class="panel">
                <div class="cat-content panel-body">
                    <div class="add-content">
                    	<button data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                        	<i class="fa fa-plus"></i>  Create Stock
                        </button>
                        <button data-toggle="modal" data-target="#mymodal" class="btn btn-danger btn-labeled">
                        	<i class="fa fa-minus"></i>  Destroy
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
                                        <form class="form-horizontal" method="post" id="cat_form" action="" onSubmit="return form_submit('Pages/function.php?product_list=ok','cat_form','?myproduct=product_list')">
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
                            <th>ID</th>
                            <th>Product Title</th>
                            <th>Entry Type</th>
                            <th>Quantity</th>
                            <th>Note</th>
                            <th>Option</th>
                       	</tr>
                       </thead>
                       <tbody>
                       		<?php 
                       			db();
                                if(isset($_GET['myproduct']) && $_GET['myproduct']=='product_list')
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
                                        <td></td>
										<td>
											<?php echo $data['cat_name']; ?>
										</td>
                                        <td></td>
                                        <td></td>
										<td class="cat-btn">
                                        	<button class="btn btn-danger btn-xs btn-delete pull-right">
                                            	<i class="fa fa-trash"></i> Delete
                                            </button>
                                            <button class="btn btn-primary btn-xs btn-edit pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px">
                                            	<i class="fa fa-wrench"></i> Edit
                                            </button>
										</td>
										<?php
										echo "</tr>";
									}
									if(!mysql_num_rows($q_e)>0)
									{?>
										<tr class="text-center">
                                        	<td colspan="8">No matching records found</td>
                                        </tr>
									<?php
                                    }
                            	}
                            ?>
                            <tr class="no-records text-center">
                                <td colspan="8">No matching records found</td>
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
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?product_list=ok','cat_form','?myproduct=product_list')">
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

/////////////////////////////////////////////////// My Products Pages End ///////////////////////////////////////////////////

/////////////////////////////////////////////////////// Reports Pages Starts //////////////////////////////////////////////////////

//------------------------------------------------ Product Compare Page Fucction -------------------------------------------//
function product_compare()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Product Sale Comparison</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="fa fa-plus"></i>  Add Category
                        </button>
                    </div>
                   <div class="show-content">
                   <table class="table table-striped table-bordered">
                       <thead>
                       	<tr>
                            <th>Logo</th>
                            <th>Display Name</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Option</th>
                       	</tr>
                       </thead>
                       	<tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="cat-btn">
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="fa fa-trash"></i> Delete</button>
                                    <button class="btn btn-info btn-xs btn-labeled pull-right" style="margin-right:4px"><i class="fa fa-usd"></i>  Pay</button>
                                    <button class="btn btn-success btn-xs pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px"><i class="fa fa-check"></i> Approval</button>
                                    <button class="btn btn-black btn-xs btn-labeled pull-right" style="margin-right:4px; background:black; color:white"><i class="fa fa-user"></i>  Profile</button>
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
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?product_list=ok','cat_form','?myproduct=product_list')">
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

//------------------------------------------------ Product Stock Report Page Fucction -------------------------------------------//
function product_stock_report()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Product Stock</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="fa fa-plus"></i>  Add Category
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
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="fa fa-trash"></i> Delete</button>
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
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?product_list=ok','cat_form','?myproduct=product_list')">
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

//------------------------------------------------ Product Wishes Page Fucction -------------------------------------------//
function product_wishes()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Product Wishes</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content">
                        <button type="button" data-toggle="modal" data-target="#mymodal" class="btn btn-primary btn-labeled">
                            <i class="fa fa-plus"></i>  Create Vendorship
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
                                    <button class="btn btn-danger btn-xs btn-labeled pull-right"><i class="fa fa-trash"></i> Delete</button>
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
                                        <form class="form-horizontal" method="post" id="edit_cat_form" action="" onSubmit="return form_submit('Pages/function.php?product_list=ok','cat_form','?myproduct=product_list')">
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

///////////////////////////////////////////////////////// Reports Pages Ends //////////////////////////////////////////////////////

//////////////////////////////////////////////////// Sales Report Pages Starts //////////////////////////////////////////////////////

function sales()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Sale</h1>
            </div>
            <div class="panel">
                <div class="panel-body cat-content">
                    <div class="add-content" style="text-align: -moz-right;">
                        <input type="search" class="form-control" placeholder="Search" style="width:358px;" />
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
                                  <th>Payment Status</th>
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
                                    <td></td>
                                    <td class="cat-btn">
                                        <button class="btn btn-danger btn-xs btn-labeled pull-right">
                                        	<i class="fa fa-trash"></i> Delete
                                        </button>
                                        <button class="btn btn-success btn-xs btn-labeled pull-right" style="margin-right:4px">
                                        	<i class="fa fa-usd"></i> Delivery Status
                                        </button>
                                        <button class="btn btn-info btn-xs pull-right btn-labeled" data-toggle="modal" data-target="#edit_cat_modal" style="margin-right:4px">
                                        	<i class="fa fa-file-text-o"></i> Full Invoice
                                        </button>
                                    </td>										
                                </tr>
                                <tr class="no-records text-center">
                                	<td colspan="8">No matching records found</td>
                                </tr>
                            </tbody>
                       </table>
                    </div>
            	</div>
        	</div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////////////// Sales Report Pages Ends //////////////////////////////////////////////////////

////////////////////////////////////////////////// Payment Settings Pages Starts ////////////////////////////////////////////////

function payment_settings()
{?>
<div class="row">
    <div class="col-sm-12">
        <div class="cat-panel">
            <div class="page-title">
            	<h1 class="text-overflow">Manage Payment Receiving Settings</h1>
            </div>
            <div class="panel panel-default bazzar-panel">
                <div class="panel-heading">
                    <h3>Payment Methode</h3>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="Pages/function.php?vendor=update_payment" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label class="control-label col-sm-3" for="ptype">Select Payment Type</label>
                            <div class="col-sm-6">
                            	<script>
									jQuery(document).ready(function(e) {
										$('#payment-type option[value="<?php echo $_SESSION['payment_type']; ?>"]').attr('selected','selected');
									});
								</script>
                                <select name="payment-type" id="payment-type" class="form-control">
                                    <option value="skrill">Skrill</option>
                                    <option value="stripe">Stripe</option>
                                    <option value="credit or debit card">Credit or Debit card</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="card">Card Number</label>
                            <div class="col-sm-6">
                                <input type="text" name="card" class="form-control" id="card" value="<?php echo $_SESSION['card_number']; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="Code">Security Code</label>
                            <div class="col-sm-6">
                                <input type="text" name="code" class="form-control" id="Code" value="<?php echo $_SESSION['security_code']; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="datepicker">Expiration Date</label>
                            <div class="col-sm-6">
								<script>
									$(function() {
										$("#datepicker").datepicker();
									});
                                </script>
                                <input type="text" name="expdate" class="form-control" id="datepicker" value="<?php echo $_SESSION['expiration_date']; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" name="submit" class="btn btn-info" style="width:100%; margin-top:15px;">
                                    <i class="fa fa-refresh"></i>Update Payment Methode
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}

///////////////////////////////////////////////// Payment Settings Pages Ends //////////////////////////////////////////////////

///////////////////////////////////////////////// Vendor Profile Page Starts ///////////////////////////////////////////////////

function vendor_profile()
{
?>

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
                        
<!-------------------------------------------------Update Profile Form Starts------------------------------------------------->
                            <div id="manage_detail" class="tab-pane fade in active">
                            	<h3>Manage Details</h3>
                                <form method="post" id="vendor_detail" class="form-horizontal form-manage-detail" enctype="multipart/form-data" onSubmit="return vendor_details('Pages/function.php?vendor=update_detail','vendor_detail','?vendor_profile=edit')">
                                    <fieldset>
                                        <legend>Business Information</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="b_nm">Business Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="b_nm" class="form-control" id="b_nm" value="<?php echo $_SESSION['business_name']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="b_nm">Select Country</label>
                                            <div class="col-sm-4">
                                                <!--JQuery Starts for Select Country-->
												<script>
                                                	jQuery(document).ready(function(e) {
                                                        $('#country option[value="<?php echo $_SESSION['country']; ?>"]').attr('selected','selected');
                                                    });
                                                </script>
                                                <select class="form-control" name="country" id="country">
                                                    <option value="AFG">Afghanistan</option>
                                                    <option value="ALA">Åland Islands</option>
                                                    <option value="ALB">Albania</option>
                                                    <option value="DZA">Algeria</option>
                                                    <option value="ASM">American Samoa</option>
                                                    <option value="AND">Andorra</option>
                                                    <option value="AGO">Angola</option>
                                                    <option value="AIA">Anguilla</option>
                                                    <option value="ATA">Antarctica</option>
                                                    <option value="ATG">Antigua and Barbuda</option>
                                                    <option value="ARG">Argentina</option>
                                                    <option value="ARM">Armenia</option>
                                                    <option value="ABW">Aruba</option>
                                                    <option value="AUS">Australia</option>
                                                    <option value="AUT">Austria</option>
                                                    <option value="AZE">Azerbaijan</option>
                                                    <option value="BHS">Bahamas</option>
                                                    <option value="BHR">Bahrain</option>
                                                    <option value="BGD">Bangladesh</option>
                                                    <option value="BRB">Barbados</option>
                                                    <option value="BLR">Belarus</option>
                                                    <option value="BEL">Belgium</option>
                                                    <option value="BLZ">Belize</option>
                                                    <option value="BEN">Benin</option>
                                                    <option value="BMU">Bermuda</option>
                                                    <option value="BTN">Bhutan</option>
                                                    <option value="BOL">Bolivia, Plurinational State of</option>
                                                    <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BIH">Bosnia and Herzegovina</option>
                                                    <option value="BWA">Botswana</option>
                                                    <option value="BVT">Bouvet Island</option>
                                                    <option value="BRA">Brazil</option>
                                                    <option value="IOT">British Indian Ocean Territory</option>
                                                    <option value="BRN">Brunei Darussalam</option>
                                                    <option value="BGR">Bulgaria</option>
                                                    <option value="BFA">Burkina Faso</option>
                                                    <option value="BDI">Burundi</option>
                                                    <option value="KHM">Cambodia</option>
                                                    <option value="CMR">Cameroon</option>
                                                    <option value="CAN">Canada</option>
                                                    <option value="CPV">Cape Verde</option>
                                                    <option value="CYM">Cayman Islands</option>
                                                    <option value="CAF">Central African Republic</option>
                                                    <option value="TCD">Chad</option>
                                                    <option value="CHL">Chile</option>
                                                    <option value="CHN">China</option>
                                                    <option value="CXR">Christmas Island</option>
                                                    <option value="CCK">Cocos (Keeling) Islands</option>
                                                    <option value="COL">Colombia</option>
                                                    <option value="COM">Comoros</option>
                                                    <option value="COG">Congo</option>
                                                    <option value="COD">Congo, the Democratic Republic of the</option>
                                                    <option value="COK">Cook Islands</option>
                                                    <option value="CRI">Costa Rica</option>
                                                    <option value="CIV">Côte d'Ivoire</option>
                                                    <option value="HRV">Croatia</option>
                                                    <option value="CUB">Cuba</option>
                                                    <option value="CUW">Curaçao</option>
                                                    <option value="CYP">Cyprus</option>
                                                    <option value="CZE">Czech Republic</option>
                                                    <option value="DNK">Denmark</option>
                                                    <option value="DJI">Djibouti</option>
                                                    <option value="DMA">Dominica</option>
                                                    <option value="DOM">Dominican Republic</option>
                                                    <option value="ECU">Ecuador</option>
                                                    <option value="EGY">Egypt</option>
                                                    <option value="SLV">El Salvador</option>
                                                    <option value="GNQ">Equatorial Guinea</option>
                                                    <option value="ERI">Eritrea</option>
                                                    <option value="EST">Estonia</option>
                                                    <option value="ETH">Ethiopia</option>
                                                    <option value="FLK">Falkland Islands (Malvinas)</option>
                                                    <option value="FRO">Faroe Islands</option>
                                                    <option value="FJI">Fiji</option>
                                                    <option value="FIN">Finland</option>
                                                    <option value="FRA">France</option>
                                                    <option value="GUF">French Guiana</option>
                                                    <option value="PYF">French Polynesia</option>
                                                    <option value="ATF">French Southern Territories</option>
                                                    <option value="GAB">Gabon</option>
                                                    <option value="GMB">Gambia</option>
                                                    <option value="GEO">Georgia</option>
                                                    <option value="DEU">Germany</option>
                                                    <option value="GHA">Ghana</option>
                                                    <option value="GIB">Gibraltar</option>
                                                    <option value="GRC">Greece</option>
                                                    <option value="GRL">Greenland</option>
                                                    <option value="GRD">Grenada</option>
                                                    <option value="GLP">Guadeloupe</option>
                                                    <option value="GUM">Guam</option>
                                                    <option value="GTM">Guatemala</option>
                                                    <option value="GGY">Guernsey</option>
                                                    <option value="GIN">Guinea</option>
                                                    <option value="GNB">Guinea-Bissau</option>
                                                    <option value="GUY">Guyana</option>
                                                    <option value="HTI">Haiti</option>
                                                    <option value="HMD">Heard Island and McDonald Islands</option>
                                                    <option value="VAT">Holy See (Vatican City State)</option>
                                                    <option value="HND">Honduras</option>
                                                    <option value="HKG">Hong Kong</option>
                                                    <option value="HUN">Hungary</option>
                                                    <option value="ISL">Iceland</option>
                                                    <option value="IND">India</option>
                                                    <option value="IDN">Indonesia</option>
                                                    <option value="IRN">Iran, Islamic Republic of</option>
                                                    <option value="IRQ">Iraq</option>
                                                    <option value="IRL">Ireland</option>
                                                    <option value="IMN">Isle of Man</option>
                                                    <option value="ISR">Israel</option>
                                                    <option value="ITA">Italy</option>
                                                    <option value="JAM">Jamaica</option>
                                                    <option value="JPN">Japan</option>
                                                    <option value="JEY">Jersey</option>
                                                    <option value="JOR">Jordan</option>
                                                    <option value="KAZ">Kazakhstan</option>
                                                    <option value="KEN">Kenya</option>
                                                    <option value="KIR">Kiribati</option>
                                                    <option value="PRK">Korea, Democratic People's Republic of</option>
                                                    <option value="KOR">Korea, Republic of</option>
                                                    <option value="KWT">Kuwait</option>
                                                    <option value="KGZ">Kyrgyzstan</option>
                                                    <option value="LAO">Lao People's Democratic Republic</option>
                                                    <option value="LVA">Latvia</option>
                                                    <option value="LBN">Lebanon</option>
                                                    <option value="LSO">Lesotho</option>
                                                    <option value="LBR">Liberia</option>
                                                    <option value="LBY">Libya</option>
                                                    <option value="LIE">Liechtenstein</option>
                                                    <option value="LTU">Lithuania</option>
                                                    <option value="LUX">Luxembourg</option>
                                                    <option value="MAC">Macao</option>
                                                    <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="MDG">Madagascar</option>
                                                    <option value="MWI">Malawi</option>
                                                    <option value="MYS">Malaysia</option>
                                                    <option value="MDV">Maldives</option>
                                                    <option value="MLI">Mali</option>
                                                    <option value="MLT">Malta</option>
                                                    <option value="MHL">Marshall Islands</option>
                                                    <option value="MTQ">Martinique</option>
                                                    <option value="MRT">Mauritania</option>
                                                    <option value="MUS">Mauritius</option>
                                                    <option value="MYT">Mayotte</option>
                                                    <option value="MEX">Mexico</option>
                                                    <option value="FSM">Micronesia, Federated States of</option>
                                                    <option value="MDA">Moldova, Republic of</option>
                                                    <option value="MCO">Monaco</option>
                                                    <option value="MNG">Mongolia</option>
                                                    <option value="MNE">Montenegro</option>
                                                    <option value="MSR">Montserrat</option>
                                                    <option value="MAR">Morocco</option>
                                                    <option value="MOZ">Mozambique</option>
                                                    <option value="MMR">Myanmar</option>
                                                    <option value="NAM">Namibia</option>
                                                    <option value="NRU">Nauru</option>
                                                    <option value="NPL">Nepal</option>
                                                    <option value="NLD">Netherlands</option>
                                                    <option value="NCL">New Caledonia</option>
                                                    <option value="NZL">New Zealand</option>
                                                    <option value="NIC">Nicaragua</option>
                                                    <option value="NER">Niger</option>
                                                    <option value="NGA">Nigeria</option>
                                                    <option value="NIU">Niue</option>
                                                    <option value="NFK">Norfolk Island</option>
                                                    <option value="MNP">Northern Mariana Islands</option>
                                                    <option value="NOR">Norway</option>
                                                    <option value="OMN">Oman</option>
                                                    <option value="PAK">Pakistan</option>
                                                    <option value="PLW">Palau</option>
                                                    <option value="PSE">Palestinian Territory, Occupied</option>
                                                    <option value="PAN">Panama</option>
                                                    <option value="PNG">Papua New Guinea</option>
                                                    <option value="PRY">Paraguay</option>
                                                    <option value="PER">Peru</option>
                                                    <option value="PHL">Philippines</option>
                                                    <option value="PCN">Pitcairn</option>
                                                    <option value="POL">Poland</option>
                                                    <option value="PRT">Portugal</option>
                                                    <option value="PRI">Puerto Rico</option>
                                                    <option value="QAT">Qatar</option>
                                                    <option value="REU">Réunion</option>
                                                    <option value="ROU">Romania</option>
                                                    <option value="RUS">Russian Federation</option>
                                                    <option value="RWA">Rwanda</option>
                                                    <option value="BLM">Saint Barthélemy</option>
                                                    <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="KNA">Saint Kitts and Nevis</option>
                                                    <option value="LCA">Saint Lucia</option>
                                                    <option value="MAF">Saint Martin (French part)</option>
                                                    <option value="SPM">Saint Pierre and Miquelon</option>
                                                    <option value="VCT">Saint Vincent and the Grenadines</option>
                                                    <option value="WSM">Samoa</option>
                                                    <option value="SMR">San Marino</option>
                                                    <option value="STP">Sao Tome and Principe</option>
                                                    <option value="SAU">Saudi Arabia</option>
                                                    <option value="SEN">Senegal</option>
                                                    <option value="SRB">Serbia</option>
                                                    <option value="SYC">Seychelles</option>
                                                    <option value="SLE">Sierra Leone</option>
                                                    <option value="SGP">Singapore</option>
                                                    <option value="SXM">Sint Maarten (Dutch part)</option>
                                                    <option value="SVK">Slovakia</option>
                                                    <option value="SVN">Slovenia</option>
                                                    <option value="SLB">Solomon Islands</option>
                                                    <option value="SOM">Somalia</option>
                                                    <option value="ZAF">South Africa</option>
                                                    <option value="SGS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="SSD">South Sudan</option>
                                                    <option value="ESP">Spain</option>
                                                    <option value="LKA">Sri Lanka</option>
                                                    <option value="SDN">Sudan</option>
                                                    <option value="SUR">Suriname</option>
                                                    <option value="SJM">Svalbard and Jan Mayen</option>
                                                    <option value="SWZ">Swaziland</option>
                                                    <option value="SWE">Sweden</option>
                                                    <option value="CHE">Switzerland</option>
                                                    <option value="SYR">Syrian Arab Republic</option>
                                                    <option value="TWN">Taiwan, Province of China</option>
                                                    <option value="TJK">Tajikistan</option>
                                                    <option value="TZA">Tanzania, United Republic of</option>
                                                    <option value="THA">Thailand</option>
                                                    <option value="TLS">Timor-Leste</option>
                                                    <option value="TGO">Togo</option>
                                                    <option value="TKL">Tokelau</option>
                                                    <option value="TON">Tonga</option>
                                                    <option value="TTO">Trinidad and Tobago</option>
                                                    <option value="TUN">Tunisia</option>
                                                    <option value="TUR">Turkey</option>
                                                    <option value="TKM">Turkmenistan</option>
                                                    <option value="TCA">Turks and Caicos Islands</option>
                                                    <option value="TUV">Tuvalu</option>
                                                    <option value="UGA">Uganda</option>
                                                    <option value="UKR">Ukraine</option>
                                                    <option value="ARE">United Arab Emirates</option>
                                                    <option value="GBR">United Kingdom</option>
                                                    <option value="USA">United States</option>
                                                    <option value="UMI">United States Minor Outlying Islands</option>
                                                    <option value="URY">Uruguay</option>
                                                    <option value="UZB">Uzbekistan</option>
                                                    <option value="VUT">Vanuatu</option>
                                                    <option value="VEN">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VNM">Viet Nam</option>
                                                    <option value="VGB">Virgin Islands, British</option>
                                                    <option value="VIR">Virgin Islands, U.S.</option>
                                                    <option value="WLF">Wallis and Futuna</option>
                                                    <option value="ESH">Western Sahara</option>
                                                    <option value="YEM">Yemen</option>
                                                    <option value="ZMB">Zambia</option>
                                                    <option value="ZWE">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="b_ct">Business City</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="b_ct" class="form-control" id="b_ct" value="<?php echo $_SESSION['business_city']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="b_st">Business State</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="b_st" class="form-control" id="b_st" value="<?php echo $_SESSION['business_state']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="b_ph">Business Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="b_ph" class="form-control" id="b_ph" value="<?php echo $_SESSION['business_phone']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="b_zip">Business Zip</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="b_zip" class="form-control" id="b_zip" value="<?php echo $_SESSION['business_zip']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="b_add">Business Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="b_add" class="form-control" id="b_add" value="<?php echo $_SESSION['business_address']; ?>" />
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Personal Information</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="f-name">First Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="fname" class="form-control" id="f-name" value="<?php echo $_SESSION['first_name']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="l-name">Last Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="lname" class="form-control" id="l-name" value="<?php echo $_SESSION['last_name']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="p_ct">Personal City</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="p_ct" class="form-control" id="p_ct" value="<?php echo $_SESSION['personal_city']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="p_st">Personal State</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="p_st" class="form-control" id="p_st" value="<?php echo $_SESSION['personal_state']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="p_ph">Personal Phone</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="p_ph" class="form-control" id="p_ph" value="<?php echo $_SESSION['personal_phone']; ?>" />
                                            </div>
                                            <label class="control-label col-sm-2" for="p_zip">Personal Zip</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="p_zip" class="form-control" id="p_zip" value="<?php echo $_SESSION['personal_zip']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="photo">Select Photo</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <label class="btn btn-info btn-file" for="multiple_input_group">
                                                            <div class="input required">
                                                            <input type="hidden" value="<?php echo $_SESSION['profile_pic']; ?>" name="pic">
                                                                <input type="file" name="vd_dp" id="multiple_input_group" class="form-control" value="<?php echo $_SESSION['profile_pic']; ?>"/>
                                                            </div> 
                                                            Browse
                                                        </label>
                                                    </span>
                                                    <span class="file-input-label">vendor_profile_pic(<?php echo $_SESSION['v_id']; ?>).<?php echo $_SESSION['profile_pic']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="p_add">Personal Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="p_add" class="form-control" id="p_add" value="<?php echo $_SESSION['personal_address']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="about">About</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="about" class="form-control" id="about" style="resize:vertical; min-height:180px;"><?php echo $_SESSION['about']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-info pull-right">
                                                <i class="fa fa-refresh"></i>Update Profile
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
<!--------------------------------------------------Update Proile Form Ends-------------------------------------------------->

<!------------------------------------------------Change Password Form Starts------------------------------------------------>
                            <div id="manage_pass" class="tab-pane fade">
                                <h3>Change Password</h3>
                                <form method="post" action="Pages/function.php?vendor=update_password" class="form-horizontal form-manage-detail">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="current-pwd">Current Password</label>
                                        <div class="col-sm-9">
                                        	<input type="password" name="current-pwd" class="form-control input-lg" placeholder="Current Password" id="current-pwd" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="new-pwd">New Password <span style="color:red">*</span></label>
                                        <div class="col-sm-9">
                                        	<input type="password" name="new-pwd" class="form-control input-lg" placeholder="Your New Password" id="new-pwd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="confirm-pwd">Confirm Password</label>
                                        <div class="col-sm-9">
                                        	<input type="password" name="confirm-pwd" class="form-control input-lg" placeholder="Confirm Password" id="confirm-pwd" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<button type="submit" name="submit" class="btn btn-info pull-right">
                                        	<i class="fa fa-refresh"></i>Update Password
                                        </button>
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

///////////////////////////////////////////////////// Vendor Profile Page Ends /////////////////////////////////////////////////

///////////////////////////////////////////// Get Main-Category Logic Starts ////////////////////////////////////////////////////////////

function get_main_category()
{
	db();
	$q="select * from main_category";
	$q_exe=mysql_query($q);
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

///////////////////////////////////////////// Get Main-Category Logic Ends ////////////////////////////////////////////////////////////

///////////////////////////////////////////// Get Category Logic Starts /////////////////////////////////////////////////////////////////

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

///////////////////////////////////////////// Get Category Logic Ends /////////////////////////////////////////////////////////////////

///////////////////////////////////////////// Get Sub-Category Logic Starts /////////////////////////////////////////////////////////

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

///////////////////////////////////////////// Get Sub-Category Logic Ends /////////////////////////////////////////////////////////
	
///////////////////////////////////////////// Get Brand Logic Starts /////////////////////////////////////////////////////////////////

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

///////////////////////////////////////////// Get Brand Logic Ends /////////////////////////////////////////////////////////////////

///////////////////////////////////////////////// PHP Starts for Request New Category ////////////////////////////////////////
if(isset($_GET['request']))
{
	if($_GET['request']=='request_category')
	{
		request_category();
	}
}
function request_category()
{
	db();
	$req_cat = $_POST['req-cat'];
	$query = "INSERT INTO request (vendor_id, vendor_name, new_category) VALUES('".$_SESSION['v_id']."','".$_SESSION['business_name']."','$req_cat')";
	$execute = mysql_query($query);
	if($execute)
	{
		echo "<script>alert('Request sent!');</script>";
		echo "<script>window.location='../index.php';</script>";
	}
	else
	{
		echo mysql_error();
	}
}
///////////////////////////////////////////////// PHP Ends for Request New Category ////////////////////////////////////////

///////////////////////////////////////////////// PHP Starts for Update Vendor's Detail ////////////////////////////////////////

db();
$q_select="SELECT password FROM register_vendor WHERE id='".$_SESSION['v_id']."'";
$q_select_exe=mysql_query($q_select);
$data_update=mysql_fetch_object($q_select_exe);

if(isset($_GET['vendor']))
{
	if($_GET['vendor']=='update_detail')
	{
		update_info();
	}
	if($_GET['vendor']=='update_password')
	{
		update_password($data_update->password);
	}
	if($_GET['vendor']=='update_payment')
	{
		update_payment();
	}
}

function update_info()
{
	db();
	if(isset($_POST['b_nm']))
	{	if($_FILES['vd_dp']['name']!='')
		{
			$path=explode('.', $_FILES['vd_dp']['name']);
			$extension=$path[count($path)-1];
		}
		else{
			$extension=$_POST['pic'];
			}
		$query="UPDATE register_vendor SET ";
		$query.="business_name='".$_POST['b_nm']."',";
		$query.="country='".$_POST['country']."',";
		$query.="business_address='".$_POST['b_add']."',";
		$query.="business_city='".$_POST['b_ct']."',";
		$query.="business_state='".$_POST['b_st']."',";
		$query.="business_phone='".$_POST['b_ph']."',";
		$query.="business_zip='".$_POST['b_zip']."',";
		$query.="f_name='".$_POST['fname']."',";
		$query.="l_name='".$_POST['lname']."',";
		$query.="personal_city='".$_POST['p_ct']."',";
		$query.="profile_pic='".$extension."',";
		$query.="personal_state='".$_POST['p_st']."',";
		$query.="personal_phone='".$_POST['p_ph']."',";
		$query.="personal_zip='".$_POST['p_zip']."',";
		$query.="personal_address='".$_POST['p_add']."',";
		$query.="about='".$_POST['about']."'";
		$query.=" WHERE id='".$_SESSION['v_id']."'";
		$execute = mysql_query($query);
		
		if($execute)
		{
			$query_vd = "SELECT * FROM register_vendor WHERE id='".$_SESSION['v_id']."'";
			$exe_vd = mysql_query($query_vd);
			if($exe_vd)
			{
				if(mysql_num_rows($exe_vd)>0)
				{
					
					$data_vd = mysql_fetch_object($exe_vd);
					session_destroy();
					session_start();
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
				}
			}
			
			if($_FILES['vd_dp']['name']!='')
			{	
				
				if(move_uploaded_file($_FILES['vd_dp']['tmp_name'],"../images/profile_pics/vendor_profile_pic(".$_SESSION['v_id'].").".$extension))
				{
							

				}
			}
		}
		else
		{
			echo mysql_error();
		}
	}
}

///////////////////////////////////////////////// PHP Ends for Update Vendor's Detail ////////////////////////////////////////

///////////////////////////////////////////////// PHP Starts for Update Vendor's Password ////////////////////////////////////////

function update_password($current_pwd)
{
	if(isset($_POST['current-pwd']))
	{
		if($_POST['current-pwd']==$current_pwd)
		{
			if($_POST['new-pwd']==$_POST['confirm-pwd'])
			{
				db();
				$q_password = "UPDATE register_vendor SET password='".$_POST['new-pwd']."' WHERE id='".$_SESSION['v_id']."'";
				$exe = mysql_query($q_password);
				if($exe)
				{?>
					<script>
						alert('Password changed successfully!\n Your new password is:<?php echo $_POST['new-pwd']; ?>');
						window.location='../index.php';
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
					window.location='../index.php';
				</script>
			<?php
			}
		}
		else
		{?>
			<script>
				alert('Wrong current password!');
				window.location='../index.php';
			</script>
		<?php
		}
	}
}
///////////////////////////////////////////////// PHP Ends for Update Vendor's Password ////////////////////////////////////////

///////////////////////////////////////////////// PHP Starts for Update Payment Methode ////////////////////////////////////////

function update_payment()
{
	db();
	if(isset($_POST['payment-type']))
	{
		$query = "UPDATE register_vendor SET payment_type='".$_POST['payment-type']."', card_number='".$_POST['card']."', security_code='".$_POST['code']."', expiration_date='".$_POST['expdate']."' WHERE id='".$_SESSION['v_id']."'";
		$execute = mysql_query($query);
		if($execute)
		{?>
			<script>
            	alert('Payment methode updated successfully!');
				window.location='../index.php';
            </script>
		<?php
        }
		else
		{
			echo mysql_error();
		}
	}
}

///////////////////////////////////////////////// PHP Ends for Update Payment Methode ////////////////////////////////////////
?>
