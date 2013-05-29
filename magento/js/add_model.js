
$(document).ready(function() {

	$("#id_project").change(function() {

		$.ajax({
			dataType: "json",
			type: "POST",
			url: "/magento/ajax/getNamespace.php",
			data: { id: $("#id_project  option:selected").val() },
			success: function( result ) {
				var project = $("#id_namespace");
				var opt;
				project.empty();
				$.each(result.namespaces, function(key, val) {
					opt = $('<option></option>').attr("value", val).text(val);
					if (val == 'Kega' || val == 'Erikt') {
						opt.attr("selected", "selected");
					}
					project.append(opt);
				})
				getModule();
			}
		});

	});

	$("#id_namespace").change(function(){
		getModule();
	});

});

getModule = function() {
	$.ajax({
		dataType: "json",
		type: "POST",
		url: "/magento/ajax/getModule.php",
		data: { path: $("#id_project  option:selected").val(),
			id: $("#id_namespace  option:selected").val()
		},
		success: function( result ) {
			var project = $("#id_module");
			var opt;
			project.empty();
			$.each(result.modules, function(key, val) {
				opt = $('<option></option>').attr("value", val).text(val);
				if (val == 'Kega' || val == 'Erikt') {
					opt.attr("selected", "selected");
				}
				project.append(opt);
			})
		}
	});

}