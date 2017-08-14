		

		$(document).ready(function(){
		var s = $("#snav");
		var pos = s.position();
		$(window).scroll(function(){
			var windowpos = $(window).scrollTop();
			if(windowpos > pos.top)
			{
				$("#snav").addClass('scrollnav');
			}
			else
			{
				$("#snav").removeClass('scrollnav');
			}
		});
		});


	$(document).ready(function(){
	$('.top').click(function(){
	$('html,body').animate({ scrollTop: 0}, 1000);
	});
	});
		


$(document).ready(function(){

$(window).scroll(function(){
var Top = $(window).scrollTop();

if(Top > 200)
{
	$('.top').show();
}
else
{
	$('.top').hide();
}

});



});