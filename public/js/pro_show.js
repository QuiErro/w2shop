$(function(){
	//数量按钮
	$(".amout_minus").click(function(){
		var now_count = parseInt($(".text_amount").val());
		if(now_count > 1){
			now_count -= 1;
		}
		$(".text_amount").val(now_count);
	});
	//数量按钮
	$(".amout_puls").click(function(){
		var now_count = parseInt($(".text_amount").val());
		now_count += 1;
		$(".text_amount").val(now_count);
	});
});
