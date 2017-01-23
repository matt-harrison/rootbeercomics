//Toggle display of color vs. black and white comics where available
function toggle(id, type){
	if(type == 'bw'){//show BW
		if($('#bw' + id)){
			$('#bw' + id).removeClass('hide');
			$('#color' + id).addClass('hide');
			$('#bwLink' + id).addClass('hide');
			$('#colorLink' + id).removeClass('hide')
		}
	}else{//show color
		if($('#color' + id)){
			$('#bw' + id).addClass('hide');
			$('#color' + id).removeClass('hide');
			$('#bwLink' + id).removeClass('hide');
			$('#colorLink' + id).addClass('hide');
		}
	}
}

//Mimic position:fixed limited to a parent div
function affix(id){
	$(window).scroll(function(){
		var obj = $('#'+id);
		var parent = obj.parent();
		var scrollPos = $(window).scrollTop();
		var objH = obj.height()+2;
		var parentH = parent.height();
		var parentY = parent.position().top;
		var parentDepth = scrollPos - parentY;
		if(parentDepth<0){
			obj.css('top','0');
		}else if(parentDepth>0 && parentH-parentDepth>objH){
			obj.css('top',5+parentDepth);
		}else{
			obj.css('top',parentH - objH);
		}
	}); 
}