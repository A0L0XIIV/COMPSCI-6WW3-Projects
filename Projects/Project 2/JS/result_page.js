function init() {
  var parkName = "Highland Garden's Park";

  var latitude = 43.246;
  var longitude = -79.891;

  // Load maps
  parkMap(parkName, latitude, longitude, "map1");
  parkMap("Chedoke Civic Golf Course", 43.248, -79.909, "map2");
  parkMap("Victoria Park", 43.263, -79.884, "map3");
  parkMap("Gage Park", 43.241, -79.83, "map4");
  // Map Results
  parkMap(parkName, latitude, longitude, "mapResultsMap");
}

function parkMap(parkDescription, coordinate_x, coordinate_y, name) {
  // Draw map w/ coordinates
  var map = L.map(name).setView([coordinate_x, coordinate_y], 15);

  // Layers and min-max zooms
  L.tileLayer("https:/a.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
    minZoom: 1
  }).addTo(map);

  // Add marker or markers on map
  // Map Results page
  if (name === "mapResultsMap") {
    var link =
      "<a href='../PagesToDevelop/individual_sample.html'>" +
      parkDescription +
      "</a>";
    addMarker(map, coordinate_x, coordinate_y, link);
    addMarker(map, 43.248, -79.909, link);
    addMarker(map, 43.263, -79.884, link);
    addMarker(map, 43.241, -79.83, link);
  }
  // Tabular Results page
  else {
    addMarker(map, coordinate_x, coordinate_y, parkDescription);
  }

  // When Tabular Results tab opened invalidateSize -> Show map
  $("a[href='#tabularResults']").on("shown.bs.tab", function(e) {
    map.invalidateSize();
  });

  // When Map Results tab opened invalidateSize -> Show map
  // Without this Map Results tab's map doesn't show
  $("a[href='#mapResults']").on("shown.bs.tab", function(e) {
    map.invalidateSize();
  });
}

function addMarker(map, x, y, description) {
  L.marker([x, y])
    .addTo(map)
    .bindPopup(description);
}

var popup = L.popup();

function onMapClick(e) {
  popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map")
    .openOn(map);
}
