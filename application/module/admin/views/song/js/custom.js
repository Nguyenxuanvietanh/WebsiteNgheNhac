

function submitForm(url){
	$('#adminForm').attr('action', url);
	$('#adminForm').submit();
}
$(document).ready(function(){
	// $("select[name='form[idcasy]']").change(function(){
	// 	$idcasy = $(this).find(":selected").val();
	// 	console.log($idcasy);
	// });
})