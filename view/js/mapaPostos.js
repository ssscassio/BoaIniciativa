var map;
function initialize(pontosLat, pontosLng){
	alert(pontosLng);
	if(getLocation())
		navigator.geolocation.getCurrentPosition(showPosition);
	var latlng = new google.maps.LatLng(latdAtual, lngAtual);
	var options = {
		zoom: 5,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

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
		marcacaoEndereco(position.coords.latitude, position.coords.longitude);
	}


	function marcacaoEndereco(lat, lng){
		var ponto = new google.maps.LatLng(lat,lng);
		var marker = new google.maps.Marker({position: ponto, map: map});
	}
}