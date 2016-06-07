function certifiInfoCheck() {	
	var username_val = document.getElementById('inputUser').value;
	var password_val = document.getElementById('inputPass').value;
	
	$.ajax({
		url:"certifiInfoGet.php",	
		type:"POST",
		data:{username:username_val, password:password_val},
		dataType:"json",
		error:function() {
			alert("error");
		},
		success:function(data) {
			var json = eval(data);
			if (json.Success == "0")
				alert("username or password not match");
			else if (json.Success == "1") {
				alert(json.imei);
				window.localStorage["imei"] = json.imei;
				window.location.href = "map.html";
			}
		}
	});
}
