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

function getpage(class_name,page_url,page_get)
{
	window.history.pushState("","",page_get);
	//alert("here");
	//alert(page_url);
	$.ajax({
			type:"GET",
			url:page_url,
			beforeSend:function()
			{
				$('#load').show();
			},
			success: function(x)
			{
				//alert(x);
				setTimeout(function()
				{
					$('#load').fadeOut();
					$('#admin_content').hide();
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
	//alert('helo');
		var record=$("#"+form_id).serialize();
		//alert(record);
			$.ajax({
				type:"POST",
				url:form_url,
				data:record,
				beforeSend:function()
				{
					$('#load').show();
				},
				success: function(s)
				{
					//alert(s);
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
			url:"Pages/function.php?mycat="+g1+"&"+g24id+"="+v,
			success: function(x){
				//alert(x);
				$('select#'+append_place).html("");
				$('select#'+append_place).append(x);	
			},
			error:function(err){alert("error : "+err);}
		});
}
