$(function(){

	/*鼠标滚动一定距离，显示快速搜索区域*/
    $(window).scroll(function () {
        if($("html,body").scrollTop() > 300){
            $(".nav_show").slideDown(500);
        }else{
            $(".nav_show").slideUp(500);
        }
    });
    
    /*设置自动播放区域*/
    var timer;
    function autoPlay(){
    	timer = setInterval(function(){
		    new_index = $(".current").index()+1;
		    if(new_index>3){new_index == 0}
		    $(".current").removeClass("current");
		    $(".con_nav>li").eq(new_index).addClass("current");
		    var $li = $(".con_img>li").eq(new_index);
		    $li.siblings().removeClass("show");
		    $li.addClass("show");
	    },3000);
    }
    autoPlay();
    $(".con_nav>li").hover(function(){
	    	clearInterval(timer);
	        $(this).addClass("current");
	        $(this).siblings().removeClass("current");
	        var index = $(this).index();
	        var $li = $(".con_img>li").eq(index);
	        $li.siblings().removeClass("show");
	        $li.addClass("show");
	    },function(){
	    	autoPlay();
	    });
	    
	/*设置二级菜单的显示效果*/
	$(".con_box>ul>li").hover(function(){
            $(this).addClass("box_current");
            $(this).children(".box_con").addClass("box_show");
        }, function(){
            $(this).removeClass("box_current");
            $(this).children(".box_con").removeClass("box_show");
        });
        
    /*设置右侧固定栏的展示效果*/
    $(".meg_nav").click(function(){
    	$("#meg").stop().animate({
    		width:315
    	},500);
    });
    $("#meg").mouseleave(function(){
    	$("#meg").stop().animate({
    		width:35
    	},500);
    });
    $(".header_search>form").submit(function(ev){
    	ev = window.event || ev; 
		if(!$(".header_search>form>input").eq(0).val()){
			ev.preventDefault();
		}
	});
	
	$(".nav_show form").submit(function(ev){
		ev = window.event || ev; 
		if(!$(".nav_show form input").eq(0).val()){
			ev.preventDefault();
		}
	});
	
	//设置.meg_show表头的全选按钮
	$("#pro_ChkAll").click(function(){
		if($(".pro_item").length == 0){
			$(this).prop("checked",false);
		}else{
			if($(this).prop("checked")){
				$(".pro_ChkElem").prop("checked",true);				
			}else{
				$(".pro_ChkElem").prop("checked",false);
			}
		}
		cal_price();
	});
	//选择商品
	$(".pro_ChkElem").click(function(){
		if($(".pro_ChkElem").length == $(".pro_ChkElem:checked").length){
			$("#pro_ChkAll").prop("checked",true);
		}else{
			$("#pro_ChkAll").prop("checked",false);
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
		var price = parseFloat($(this).parents(".pro_item").find(".item_one").text().substr(1));
		$(this).parents(".item_content").find(".item-sum strong").text("¥"+((price*now_count).toFixed(2)));
		cal_price();
	});
	//数量按钮
	$(".amout_puls").click(function(){
		var now_count = parseInt($(this).parents(".item-amout").children(".text_amount").val());
		now_count += 1;
		$(this).parents(".item-amout").children(".text_amount").val(now_count);
		var price = parseFloat($(this).parents(".pro_item").find(".item_one").text().substr(1));
		$(this).parents(".item_content").find(".item-sum strong").text("¥"+((price*now_count).toFixed(2)));
		cal_price();
	});
	//计算已选中的商品的总金额
	function cal_price(){
		var total_amount = $(".pro_ChkElem:checked").length;
		var total_price = 0;
		for(var i=0; i<total_amount; i++){
			total_price += parseFloat($(".pro_ChkElem:checked").eq(i).parents(".item_content").find(".item-sum strong").text().substr(1));
		}
		$(".total_price").text("¥" + total_price.toFixed(2));
		$(".total_count").text(total_amount);
		if(total_amount){
			$(".pro_cashier").addClass("btn-allow");
		}else{
			$(".pro_cashier").removeClass("btn-allow");
		}
	}
	
});