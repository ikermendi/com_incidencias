  var berlin = new google.maps.LatLng(52.520816, 13.410186);
  var markers = [];
  var iterator = 0;
 var neighborhoods = [];
var contentString = [];


  var map;

  function initialize() {
    var mapOptions = {
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: berlin
    };

    map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
  }

  function setData(nei, content) {
	neighborhoods = nei;
	contentString = content;
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
	
	var marker = new google.maps.Marker({
      position: neighborhoods[iterator],
      map: map,
      draggable: false,
      animation: google.maps.Animation.DROP
    });

	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});
	
	google.maps.event.addListener(map, 'click', function() {
	  infowindow.close();
	});
	
    markers.push(marker);

    iterator++;
  }