function change(id) {
	var sight = $(id);
	var smallpic = sight.attr("src");
	var bigpic = $("#big").attr("src");
	var rexp = /[^\/]*$/;
	smallpic = smallpic.match(rexp); 
	bigpic = bigpic.match(rexp); 
		if (smallpic != bigpic) {
			var newsrc = "pictures/toysbig/" + smallpic;
			$("#big").attr("src", newsrc);
			$("#small img").addClass("dim");
			sight.removeClass("dim");
		}
}