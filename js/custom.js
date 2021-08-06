$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({ placement: "bottom"});   
});
$(document).ready(function() {
	$('.find-select').select2({theme: "bootstrap"});
});
$(document).ready(function() {
	$('.single-select').select2({theme: "bootstrap", minimumResultsForSearch: Infinity});
});
function showToast(msgType, msgContent){
	toastr.options.positionClass = 'toast-bottom-right';
	toastr.options.closeButton = true;
	toastr.options.progressBar = true;
	if (msgType == "SUCCESS"){
		toastr.success(msgContent);
	}else if(msgType == "ERROR"){
		toastr.error(msgContent);
	}
}