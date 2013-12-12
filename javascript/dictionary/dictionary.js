$().ready(function()
          {
		$("#dictionary").autocomplete("dermlex.php", {
		width: 260,
		selectFirst: false
	});

	$("#dictionary").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});
	$(".dictionary1").autocomplete("dermlex.php", {
		width: 260,
		selectFirst: false
	});

	$(".dictionary1").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});
	$("#dictionary2").autocomplete("dermlex.php", {
		width: 260,
		selectFirst: false
	});

	$("#dictionary2").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});
	$("#dictionary3").autocomplete("dermlex.php", {
		width: 260,
		selectFirst: false
	});

	$("#dictionary3").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});
	$("#dictionary5").autocomplete("dermlex.php", {
		width: 260,
		selectFirst: false
	});

	$("#dictionary5").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("input").val(data[1]);
	});
        $("#dictionary4").autocomplete("patient_list.php", {
		width: 260,
                height: 100,
		selectFirst: false
	});

	$("#dictionary4").result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find("text").val(data[1]);
	});
	$("#scrollChange").click(changeScrollHeight);
	
	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
});