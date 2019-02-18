$(function(){
	//设置表头的全选按钮
	$(".con_selectAll").click(function(){
		if($(".pro").length == 0){
			$(this).prop("checked",false);
		}else{
			if($(this).prop("checked")){
				$(".checkBox").prop("checked",true);
				$(".foot_selectAll").prop("checked",true);
			}else{
				$(".checkBox").prop("checked",false);
				$(".foot_selectAll").prop("checked",false);
			}
		}
		cal_price();
	});
	//设置底部区域的全选按钮
	$(".foot_selectAll").click(function(){
		if($(".pro").length == 0){
			$(this).prop("checked",false);
		}else{
			if($(this).prop("checked")){
				$(".checkBox").prop("checked",true);
				$(".con_selectAll").prop("checked",true);
			}else{
				$(".checkBox").prop("checked",false);
				$(".con_selectAll").prop("checked",false);
			}
		}
		cal_price();
	});
	//数量按钮
	$(".amout_minus").click(function(){
		var now_count = parseInt($(this).parents(".item-amout").children(".text_amount").val());
		if(now_count > 1){
			now_count -= 1;
		}
		$(this).parents(".item-amout").children(".text_amount").val(now_count);
		var price = parseFloat($(this).parents(".td-amount").siblings(".td-price").children("strong").text().substr(1));
		$(this).parents(".td-amount").siblings(".td-sum").children("strong").text("￥"+((price*now_count).toFixed(2)));
		cal_price();
	});
	//数量按钮
	$(".amout_puls").click(function(){
		var now_count = parseInt($(this).parents(".item-amout").children(".text_amount").val());
		now_count += 1;
		$(this).parents(".item-amout").children(".text_amount").val(now_count);
		var price = parseFloat($(this).parents(".td-amount").siblings(".td-price").children("strong").text().substr(1));
		$(this).parents(".td-amount").siblings(".td-sum").children("strong").text("￥"+((price*now_count).toFixed(2)));
		cal_price();
	});
	//删除商品
	$(".td-op a").click(function(){
		$(this).parents("div.pro").remove();
		if($(".pro").length == 0){
			$(".con_selectAll").prop("checked",false);
			$(".foot_selectAll").prop("checked",false);
		}
		cal_price();
	});
	//底部区域的删除按钮
	$(".foot_remove").click(function(){
		$(".checkBox:checked").parents("div.pro").remove();
		if($(".pro").length == 0){
			$(".con_selectAll").prop("checked",false);
			$(".foot_selectAll").prop("checked",false);
		}
		cal_price();
	});
	//选择商品
	$(".checkBox").click(function(){
		if($(".checkBox").length == $(".checkBox:checked").length){
			$(".con_selectAll").prop("checked",true);
			$(".foot_selectAll").prop("checked",true);
		}else{
			$(".con_selectAll").prop("checked",false);
			$(".foot_selectAll").prop("checked",false);
		}
		cal_price();
	});
	//计算已选中的商品的总金额
	function cal_price(){
		var total_amount = $(".checkBox:checked").length;
		var total_price = 0;
		for(var i=0; i<total_amount; i++){
			total_price += parseFloat($(".checkBox:checked").eq(i).parents("ul.item_content").children("li").eq(4).text().substr(1));
		}
		$(".selected_price").text(total_price.toFixed(2));
		$("#selected_amout").text(total_amount);
		if(total_amount){
			$(".btn-sumbit").addClass("btn-allow");
		}else{
			$(".btn-sumbit").removeClass("btn-allow");
		}
	}
});
