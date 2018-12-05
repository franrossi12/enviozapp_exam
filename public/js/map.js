var map
var markers = []

$(function () {
  $('#people').change(function (e) {
    filter($(this).val())
  });
});

function filter(personID) {
  $.each(markers, function(key, marker) {
    if (marker.properties.person_id == personID || personID === "") {
      marker.setVisible(true)
    } else {
      marker.setVisible(false)
    }
  });
}

function initData() {
  $("#people").append('<option value="" selected>Choose Person</option>')

  $.each(peoplaArray, function(key, person) {
    $("#people").append('<option value="'+ person.id +'">'+ person.name +'</option>')
    if ( person.locations.length > 0 ) {
      $.each(person.locations, function (key, location) {
        var infoWindow = new google.maps.InfoWindow()
        var point = new google.maps.LatLng(
          parseFloat(location.latitude),
          parseFloat(location.longitude));

        var titleText = "Location N° " + ( key+1 )+ " - Person " + person.name + " "+ person.last_name;
        var marker = new google.maps.Marker({
          position: point,
          title: titleText,
          map: map,
          properties: location
        });

        var markerInfo = "<div><h4>" + titleText + "</h4></div>"

        marker.addListener('click', function () {
          infoWindow.close()
          infoWindow.setContent(markerInfo)
          infoWindow.open(map, marker)
        });
        markers.push(marker)
      });
    }
  });
}

function initMap() {
  map_options = {
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.HYBRID,
    center: {lat: -32.959257, lng: -60.639861}
  }

  map_document = document.getElementById('map')
  map = new google.maps.Map(map_document,map_options);
  initData()

}