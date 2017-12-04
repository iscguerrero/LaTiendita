$(document).ready(function () {
	
});

// Ajax generico
var ajax = function (url, str) {
	response = [];
	$.ajax({
		url: url,
		data: str,
		type: 'POST',
		async: false,
		cache: false,
		dataType: 'json',
		success: function (json) {
			response = json;
		}
	});
	return response;
}