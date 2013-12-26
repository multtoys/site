	$(document).ready(function() {

		var dog = $("#pluto").attr("src");
		var rex = /^.*\/(?=[^\/]*$)/;
		var direct = dog.match(rex);
		$("#pluto").mouseover(function(){
			$("#pluto").attr("src", direct+"plutoserves.png");
		}).mouseout(function(){
			$("#pluto").attr("src", dog);
		});
	})
	
	function erasing() {
		if ($("#invitation").attr("value") == "Напиши, что найти...") $("#invitation").attr("value", "");
	}
