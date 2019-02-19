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
	
	//删除商品
	// $(".remove_btn").click(function(){
	// 	$(".checkbox_btn:checked").each(function(){
	// 		$(this).parents("#pro_tab tr").remove();
	// 	});
	// 	//删除完后对当前商品按照id号重新排序
	// 	sort();
	// });
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
	
		/*检验重复添加的商品
		for(var i=0; i<$("#pro_tab tr").length; i++){
			if($("#pro_tab tr").eq(i).children("td").eq(1).text() == new_idNum){
				return;
			}
		}  
		var td1 = $("<td>"+length+"</td>");
		var td2 = $("<td>"+new_idNum+"</td>");
		var td3 = $("<td>"+new_name+"</td>");
		var td4 = $("<td>"+new_brief+"</td>");
		var td5 = $("<td>"+new_desc+"</td>");
		var td6 = $("<td>"+new_class+"</td>");
		var td7 = $("<td>"+new_price+"</td>");
		var td8 = $("<td><img src="+new_img+"/></td>");
		var td9 = $("<td><img src="+new_thumb+"/></td>");
		var td10 = $("<td>已上架</td>");
		var td11 = $("<td>"+new_count+"</td>");
		var td12 = $("<td>"+new_time+"</td>");
		var td13 = $("<td><input type=\"checkbox\" class=\"checkbox_btn\"/></td>");
		var td14 = $("<td><button class=\"adapt_btn\">修改</button></td>");
			
		var new_tr = $("<tr></tr>");
		new_tr.append(td1);
		new_tr.append(td2);
		new_tr.append(td3);
		new_tr.append(td4);
		new_tr.append(td5);
		new_tr.append(td6);
		new_tr.append(td7);
		new_tr.append(td8);
		new_tr.append(td9);
		new_tr.append(td10);
		new_tr.append(td11);
		new_tr.append(td12);
		new_tr.append(td13);
		new_tr.append(td14);
		$("#pro_tab").append(new_tr);			
		//添加后重新排序表格
		sort();
		*/
	});
	
	//修改商品信息
	$(".adapt_btn").click(function(ev){
		
		var that = $(this);
		//显示修改表单
		$("#adapt_form").show();
		
		//设置body高度
    	$("html,body").height($(document).height());
     
		//表单的取消按钮
		$("#form_adapt_close").click(function(){
			$("#adapt_form").hide();
		});
		
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
		
		//修改表单的修改按钮
		$("#form_adapt_add").click(function(){
			//adaptClick([id_td,name_td,brief_td,desc_td,cat_td,price_td,on_td,count_td]);
			// $(".adapt_text").val('');
			$("#adapt_form").hide();
		});
	});
	/*
	function adaptClick(arr){	
		var new_idNum = $("#adapt_id").val() || arr[0].text();
		var new_name = $("#adapt_name").val() || arr[1].text();
		var new_brief = $("#adapt_brief").val() || arr[2].text();
		var new_desc = $("#adapt_desc").val() || arr[3].text();
		var new_class = $("#adapt_class").val() || arr[4].text();
		var new_price = $("#adapt_price").val() || arr[5].text();
		var new_count = $("#adapt_count").val() || arr[7].text(); 
		var new_on = $("#adapt_select").val();
		//var new_img = $("#adapt_img").val()|| img_td.children("img")[0].attr("src");
		//var new_thumb = $("#adapt_thumb").val()|| thumb_td.children("img")[0].attr("src");
		//img_td.children("img")[0].attr("src","url("+new_img+")");
		//thumb_td.children("img")[0].attr("src","url("+new_thumb+")");
			
		
		arr[0].text(new_idNum);
		arr[1].text(new_name);
		arr[2].text(new_brief);
		arr[3].text(new_desc);
		arr[4].text(new_class);
		arr[5].text(new_price);
		arr[7].text(new_count);
		arr[6].text(new_on);
	}
	//
	$(".adapt_btn").click(function(){
		
		var price_td = $(this).parents('tr').children('td').eq(6);
		var ori_price = price_td.text();
		var input = $("<input type='text'/>");
		price_td.html(input);
		input.focus();
		input.blur(function(){
			var new_price = $(this).val() || ori_price;
			price_td.html(new_price);
		});
	});
	*/
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
