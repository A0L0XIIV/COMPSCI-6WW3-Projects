function init() {
  var parkName = "Highland Garden's Park";

  var coordinate_x = 43.246;
  var coordinate_y = -79.891;

  // Load maps
  parkMap(parkName, coordinate_x, coordinate_y, "map1");
  parkMap("Chedoke Civic Golf Course", 43.248, -79.909, "map2");
  parkMap("Victoria Park", 43.263, -79.884, "map3");
  parkMap("Gage Park", 43.241, -79.83, "map4");
}

function parkMap(parkName, coordinate_x, coordinate_y, name) {
  var mymap = L.map(name).setView([coordinate_x, coordinate_y], 15);

  L.tileLayer("https:/a.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
  }).addTo(mymap);

  L.marker([coordinate_x, coordinate_y])
    .addTo(mymap)
    .bindPopup(parkName);
}

var popup = L.popup();

function onMapClick(e) {
  popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map")
    .openOn(map);
}
