function getGyro(){
	if(window.orientation == 0){
		$("#frame").removeClass("hor").addClass("vert");
	}else if(window.orientation == 90 || orientation == -90){
		$("#frame").removeClass("vert").addClass("hor");
	}
	distribute();
}
window.onorientationchange=getGyro;