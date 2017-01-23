$(document).ready(function(){
	var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
	if(!mobile){
		$('#mini-header').removeClass('fs24');
		$('#mini-footer').removeClass('fs24');
		$('#mini-header>div').removeClass('p20').addClass('p10');
		$('#mini-footer>div').removeClass('p20').addClass('p10');
	}
});