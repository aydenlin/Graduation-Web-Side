function locUpdate() {
	var imei_val = window.localStorage["imei"];
	;
	$.ajax({
		url:"locInfoObtain.php",
		type:"POST",
		data:{flag:"full", imei_val},
		dataType:"json",
		error:function() {
			alert("error");
		},
		success:function(data) {
			var json = eval(data);
			var total = json.num;
			var i_long = 0;
			var i_lati = 0;
			var i_long_next = 0;
			var i_lati_next = 0;
			
			for (var i=0; i<total-1; i++) {
				i_long = 2*i;
				i_lati = i_long+1;
				i_long_next = 2*(i+1);
				i_lati_next = i_long_next+1;
				
				point_curr = new BMap.Point(json[i_long],json[i_lati]);
				point_next = new BMap.Point(json[i_long_next], json[i_lati_next]);
				window.map.addOverlay(new BMap.Polyline([point_curr, point_next], {strokeColor:"blue", strokeWeight:6, strokeOpacity:0.5}));
			} 
		}
	});
}
