	function deltoy(toy) {
		var line = $(toy);
		line.hide(500, function() {line.remove();});
	}
	
	function recalc() {
		var maxn = $("#dtls input").size();
		var price;
		var quant;
		var t;
		var amount = 0;
		for (var i = 0; i < maxn; i++) {
			quant = $("#dtls input").eq(i).val();
			t = $("#dtls td").eq(5*i+4).text();
			price = parseFloat(t);
			amount = amount + quant*price;
		}
		$("#dtls td").eq(maxn*5+2).text(amount + " руб.")
	}