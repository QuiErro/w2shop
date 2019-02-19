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
    $(".meg_shoppingbag").click(function(){
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
});