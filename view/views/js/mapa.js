var map;
function initialize(){
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

	var options = {
		zoom: 5,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map"), options);

}

	function marcacaoEndereco(postos){
		//separando postos de coleto
		var enderecos = new Array();
		enderecos = postos.split("|");
		//buscando latitude e longitude por endereco (formato: nome rua, numero, bairro )
		var geocoder = new google.maps.Geocode();

		for(var i = 0; i < enderecos.length; i++){
			geocoder.geocode({ 'address': enderecos[i] }, function(results, status){
				//se status ok
				if (status = google.maps.GeocoderStatus.OK){
					//pega o retorno que ehlat e long
					var latlng = results[0].geometry.location;
					//faz marcacao
					var maker = new google.maps.Marker({position: latlng, map: map});
					map.setCenter(latlng);//coloca na posicao da marcacao
				}	
			});
	}

}