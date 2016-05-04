var map;
function initialize(pontosLat, pontosLng){
	if(getLocation())
		navigator.geolocation.getCurrentPosition(showPosition);
	else{
		var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
		var options = {
			zoom: 5,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	}
	map = new google.maps.Map(document.getElementById("mapaPostos"), options);
	for (var i = 0; i < pontosLat.length; i++) {
		marcacaoEndereco(pontosLat[i], pontosLng[i]);
	};
	

	function getLocation(){
		if(navigator.getLocation)		
			return true;
		else
			return false;
	}
	function showPosition(position){
		var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		var options = {
			zoom: 5,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	}


	function marcacaoEndereco(lat, lng){
		var ponto = new google.maps.LatLng(lat,lng);
		var marker = new google.maps.Marker({position: ponto, map: map});
	}
}