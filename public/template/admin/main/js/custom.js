$(document).ready(function(){

    $('input[name=selectAll]').change(function(){
		var checkStatus = this.checked;
		$('#adminForm').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
    });
    
    $('.filter button[name=btnSearch]').click(function(){
        $('#adminForm').submit();
    });

    $('.filter button[name=btnClear]').click(function(){
        $('input[name=search]').val('');
        $('#adminForm').submit();
    });

    $('.filter-group select[name=filterStatus]').change(function(){
        $('#adminForm').submit();
    });
});



function changeStatus(url){
    $.get(url, function (data){


        var element = 'a#status-' + data['id'];
        var classRemove = 'check';
        var classAdd = 'uncheck';
        if(data['status'] == 1){
            classRemove = 'uncheck';
            classAdd = 'check';
        }
        $(element).attr('href', "javascript:changeStatus('"+ data['link'] +"')");
        $(element + ' span').removeClass(classRemove).addClass(classAdd);
    }, 'json');
}



