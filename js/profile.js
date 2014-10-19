function userprofile(data) {
	$("#name") .html("<strong>Name:</strong> " + data["name"]);
	$("#age")  .html("<strong>Age: </strong>" + data["age"]);
	$("#money").html("<strong>Money:</strong> " + data["money"]);

	if(data["motd"] != "") {
		$("#motd").html("<strong>Motd:</strong> " + data["motd"]);
	}
}
