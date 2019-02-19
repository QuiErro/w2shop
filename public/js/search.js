$(function(){
	//获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var URL = decodeURI(window.location.search);
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null){
        	return decodeURI(r[2]); 
        } 
        return null; //返回参数值
    }
    var keyword = getUrlParam("keyword");
    $(".header_search>form>input").eq(0).val(keyword);
    
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
	$(".header_search>form").submit(function(ev){
		ev = window.event || ev;
		if(!$(".header_search>form>input").eq(0).val()){
			ev.preventDefault();
		}
		var keyword = getUrlParam("keyword");
    	$(".header_search>form>input").eq(0).val(keyword);
	});
});
