$(function(){
	//设置body高度
     $("html,body").height($(document).height());
     
	//点击页面左侧的菜单栏,切换对应的内容区域
	$(".oper").click(function(){
		$(this).siblings().removeClass("oper_current");
		$(this).addClass("oper_current");
		$index = $(this).index();
		$(".oper_box").removeClass("box_current");
		$(".oper_box").eq($index-1).addClass("box_current");
		
		$("html,body").height($(document).height());
	});
	
	//点击刷新按钮刷新当前页面
	$(".reload_btn").click(function(){
		window.location.reload();
	});
	
	//查找商品
	$(".search_btn").click(function(){
		$("#pro_tab tr").removeClass("tr_current");
		var idNum = $(".search_text").val();
		for(var i=0; i<$("#pro_tab tr").length; i++){
			if($("#pro_tab tr").eq(i).children("td").eq(0).text() == idNum){
				$("#pro_tab tr").eq(i).addClass("tr_current");
				break;
			}
		}
		if(i >= $("#pro_tab tr").length){
			alert("该商品尚未上架");
		}
		$(".search_text").val('');
	});
	
	//商品上架区域
		//选择图片
	$("#add_img").change(function(){
		var new_img = $("#add_img").val();
		if(new_img){		
			$(".add_file").eq(0).css("background-image","url("+new_img+")");
		}
	});
	$("#add_thumb").change(function(){
		var new_thumb = $("#add_thumb").val();
		if(new_thumb){
			$(".add_file").eq(1).css("background-image","url("+new_thumb+")");
		}
	});
	
	$("#form_add").click(function(){
		var new_name = $("#add_name").val();
		var new_brief = $("#add_brief").val();
		var new_desc = $("#add_desc").val();
		var new_class = $("#add_class").val();
		var new_price = $("#add_price").val();
		var new_img = $("#add_img").val();
		var new_count = $("#add_count").val();
		if(!new_brief || !new_name || !new_desc || !new_class || !new_price || !new_img || !new_count){
			if(!new_brief){
				$(".brief_check").show();
			}else{
				$(".brief_check").hide();
			}
			if(!new_name){
				$(".name_check").show();
			}else{
				$(".name_check").hide();
			}	
			if(!new_desc){
				$(".desc_check").show();
			}else{
				$(".desc_check").hide();
			}	
			if(!new_class){
				$(".cat_check").show();
			}else{
				$(".cat_check").hide();
			}	
			if(!new_price){
				$(".price_check").show();
			}else{
				$(".price_check").hide();
			}	
			if(!new_img){
				$(".img_check").show();
			}else{
				$(".img_check").hide();
			}	
			if(!new_count){
				$(".count_check").show();
			}else{
				$(".count_check").hide();
			}	
		    $("html,body").height($(document).height());
			return;
		}
		$(".brief_check").hide();
		$(".name_check").hide();
		$(".img_check").hide();
		$(".count_check").hide();
		$(".price_check").hide();
		$(".cat_check").hide();
		$(".desc_check").hide();
	});
	
	//修改商品信息
	$(".adapt_btn").click(function(ev){
		
		var that = $(this);
		//显示修改表单
		$("#adapt_form").show();
		
		//设置body高度
    	$("html,body").height($(document).height());

        var id_td = $(this).parents('tr').children('.id').eq(0);
		var name_td = $(this).parents('tr').children('.name').eq(0);
		var brief_td = $(this).parents('tr').children('.brief').eq(0);
		var desc_td = $(this).parents('tr').children('.desc').eq(0);
		var cat_td = $(this).parents('tr').children('.category').eq(0);
		var price_td = $(this).parents('tr').children('.shop_price').eq(0);
		var on_td = $(this).parents('tr').children('.onsale').eq(0);	
		var count_td = $(this).parents('tr').children('.onsale_count').eq(0);	
		//设置文本框的默认值
		$("#adapt_id").val(id_td.text());
		$("#adapt_name").val(name_td.text());
		$("#adapt_class").val(cat_td.text());
		$("#adapt_price").val(price_td.text());
		$("#adapt_desc").val(desc_td.text());
		$("#adapt_brief").val(brief_td.text());
        $("#adapt_count").val(count_td.text());
        /*
           //表单的取消按钮
           $("#form_adapt_close").click(function(){
               $("#adapt_form").hide();
           });

           //修改表单的修改按钮
           $("#form_adapt_add").click(function(){
               //adaptClick([id_td,name_td,brief_td,desc_td,cat_td,price_td,on_td,count_td]);
               //$(".adapt_text").val('');
               $("#adapt_form").hide();
           });
           */
	});

    //商品排序函数
	function sort(){
		var arr = [];
		for(i=0; i<$("#pro_tab tr").length; i++){
			arr.push($("#pro_tab tr").eq(i));
		}
		arr.sort(function(n1,n2){
			return $(n1).children("td").eq(0).text() - $(n2).children("td").eq(0).text();
		});
		$("#pro_tab").text('');
		for(i=0; i<arr.length; i++){
			arr[i].children("td").eq(0).text(i);
			$("#pro_tab").append(arr[i]);
		}
	}
	//页码
	$(".pag_a").click(function(){
		$(this).addClass('pag_active');
		$(this).parent('li').siblings().children('a').removeClass('pag_active');
	});
	
	$(".pag_back").click(function(){
		if($(".pag_active").text() != '1'){
			var new_index = parseInt($(".pag_active").text())-1;
			$(".pagination li").eq(new_index).children('a').addClass('pag_active');
			$(".pagination li").eq(new_index).siblings().children('a').removeClass('pag_active');
		}
	});
	$(".pag_go").click(function(){
		if($(".pag_active").text() != '5'){
			var new_index = parseInt($(".pag_active").text())+1;
			$(".pagination li").eq(new_index).children('a').addClass('pag_active');
			$(".pagination li").eq(new_index).siblings().children('a').removeClass('pag_active');
		}
	});
	
});
