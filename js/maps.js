var bounds = new google.maps.LatLngBounds();
var markers = [];
var iterator = 0;
var neighborhoods = [];
var contentString = [];
var estado = [];
var iconBien = new google.maps.MarkerImage("components/com_incidencias/images/marker_ok.png");
var iconMal = new google.maps.MarkerImage("components/com_incidencias/images/marker_ko.png");

  var map;

  function initialize() {
    var mapOptions = {
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
  }

  function setData(nei, content, esta, center) {
	neighborhoods = nei;
	contentString = content;
	estado = esta;
  }

  function drop() {
    for (var i = 0; i < neighborhoods.length; i++) {
      setTimeout(function() {
        addMarker();
      }, i * 200);
    }
  }

  function addMarker() {
	
	var infowindow = new google.maps.InfoWindow({
	    content: contentString[iterator]
	});
	
	var marker;
	
	if(estado[iterator] == 1) {
		marker = new google.maps.Marker({
      		position: neighborhoods[iterator],
      		map: map,
	  		icon: iconBien,
      		draggable: false,
      		animation: google.maps.Animation.DROP
    });
	} else {
		marker = new google.maps.Marker({
	    	position: neighborhoods[iterator],
	    	map: map,
			icon: iconMal,
	    	draggable: false,
	    	animation: google.maps.Animation.DROP
	    });
	}
	
	bounds.extend(marker.getPosition());
	map.fitBounds(bounds);

	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});
	
	google.maps.event.addListener(map, 'click', function() {
	  infowindow.close();
	});
	
    markers.push(marker);

    iterator++;
  }