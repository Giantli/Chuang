
	$('.slider').slick({
				autoplay:true,
				autoplaySpeed:3000,
			    draggable: true,
			    arrows: false,
			    dots: true,
			    fade: true,
			    speed: 900,
			    infinite: true,
			    cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
			    touchThreshold: 100
	})


window.onscroll = function() {
	var psBody=document.getElementById("psBody");
	var height=window.scrollY;
	if(height>=1000){
		// console.log(height);
		psBody.style.position="fixed";
	}else{
		psBody.style.position="";
	}
    

}

function a(x,y){
	l = $('#main').offset().left;
	w = $('#main').width();
	$('#tbox').css('left',(l + w + x) + 'px');
	$('#tbox').css('bottom',y + 'px');
}
function b(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h){
		$('#gotop').fadeIn('slow');
	}else{
		$('#gotop').fadeOut('slow');
	}
}
$(document).ready(function(e) {		
	a(10,10);//#tbox的div距浏览器底部和页面内容区域右侧的距离
	b();
	$('#gotop').click(function(){
		$(document).scrollTop(0);	
	})
});
$(window).resize(function(){
	a(10,10);//#tbox的div距浏览器底部和页面内容区域右侧的距离
});

$(window).scroll(function(e){
	b();		
})
