$(document).ready(function()
{
	$(".navbar_right").click(function()
	{
		$('#admin-info ul').slideToggle();
		$("#admin-info ul").mouseleave(function(){
    	$(this).fadeOut();
		});
	});
});

////////////////////////// Active Class Function //////////////////////////

$(function ()
{
	$('.left-menu .panel-heading').click(function ()
	{
        $('.left-menu .panel-heading').removeClass('active0');
		$(this).addClass('active0');
    });
});

//////////////////////////////// Get Page Function (Dynamicaly) /////////////////////////////

function getpage(class_name,page_url)
{
	$.ajax({
			type:"GET",
			url:page_url,
			beforeSend:function()
			{
				$('#load').show();
			},
			success: function(x)
			{
				setTimeout(function()
				{
					
					$('#load').fadeOut();
					
					$('#admin_content').html(x);
					$('#admin_content').fadeIn(1000);
					$(".left-menu .panel a").removeClass('active1');
					$("a." + class_name).addClass('active1');
				},500);
				
			},
				error:function(err){alert(err);}
			});
}

/////////////////////////////////////////////Submit Category Function (Dynamicaly) ////////////////////////////////////////////////

function form_submit(form_url,form_id,redirect_url="")
{
	var myform = document.getElementById(form_id);
	//var record = $("#"+form_id).serialize();
	var record = new FormData(myform);
	$.ajax({
		type:"POST",
		url:form_url,
		data:record,
		contentType: false,       // The content type used when sending data to the server.
		cache: false,
		processData:false,
		beforeSend:function()
		{
			$('#load').show();
		},
		success: function(s)
		{
			//alert('Submition Successfull!');
			$('#mymodal').modal('hide');
			$('#load').hide();
			$('#modal_cat').fadeOut(500);
			getpage('add_item','Pages/function.php'+redirect_url);
		}
	});
	return false;
}

//////////////////////////////// Category Select Function /////////////////////////////

function get_option(v,g1,g24id,append_place)
{
	//alert(v);
	$.ajax({
			type:"GET",
			url:"Pages/function.php?myproduct="+g1+"&"+g24id+"="+v,
			success: function(x){
				//alert(x);
				$('select#'+append_place).html("");
				$('select#'+append_place).append(x);	
			},
			error:function(err){alert("error : "+err);}
		});
}

//////////////////////////////// Product-List Functions /////////////////////////////

function create_product()
{
	$('#show-prod').hide();
	$('#create-prod').show();
}
function back_to_product()
{
	$('#show-prod').show();
	$('#create-prod').hide();
}

//////////////////////////////// AJAX Starts for Update Vendor's Detail /////////////////////////////

function vendor_details(form_url,form_id,redirect_url="")
{
	        
	var myform = document.getElementById(form_id);
	//var detailvalue = $('#vendor_detail').serialize();
	var b=$("#"+form_id+' input[type=file]').val();
	//alert(b);
	var detailvalue = new FormData(myform);
	$.ajax({
		type:'post',
		url:form_url,
		data:detailvalue,
		contentType: false,       // The content type used when sending data to the server.
		cache: false,
		processData:false,
		beforeSend: function(){
			$('button.btn-info').html('<img src="images/refresh.gif" style="margin-right:5px; border-right:1px solid rgba(176,176,176,0.2); width:18px;"/> Updating...');
			$('button.btn-info').addClass('disabled');
		},
		success: function(details){
			alert('Updated Succefully!');
			//alert(details);
			getpage('add_item','Pages/function.php'+redirect_url);
		}
	});
	return false;
}

//////////////////////////////// Delete Products /////////////////////////////

function confirm_model(id)
{
	$('#modal-4').modal("show");
	$('#modal-4 .modal-dialog .modal-content .modal-footer a.btn').attr("onClick","del_prod("+id+")");
}
function del_prod(id)
{
	//alert(id);
	$.ajax({
		type:"GET",
		url:"Pages/function.php?myproduct=product&delete_product="+id,
		success: function(del){
			if(del='success')
			{
				alert('Book deleted!');
				$('#modal-4').modal("hide");
				getpage('add_item','Pages/function.php?myproduct=product_list');
			}
		}
	});
}
