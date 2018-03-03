$("#search").on('input', function(){
	$.ajax({
		type: 'POST',
		url: "requests_ajax.php",
		data: {
			searchText: $('#search').val()
		},
		success: function(result){
        	$("#request_list").html(result);
    	}
    });
});

$("#my_request_search").on('input', function(){
	$.ajax({
		type: 'POST',
		url: "requests_ajax.php",
		data: {
			searchText: $('#my_request_search').val(),
			customer_id: $('#customer_id').val()
		},
		success: function(result){
        	$("#my_request_list").html(result);
    	}
    });
});

$('#datepicker').datepicker({
	format: 'yyyy-mm-dd',
	uiLibrary: 'bootstrap4'
});