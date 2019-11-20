// Init function -> body calls it
function init() {
  // Set dynamic variables in init function
  var parkName = "Highland Garden's Park";

  var latitude = 43.246;
  var longitude = -79.891;

  // Load Tabular results' maps -> 4 results, 4 maps
  parkMap(parkName, latitude, longitude, "map1");
  parkMap("Chedoke Civic Golf Course", 43.248, -79.909, "map2");
  parkMap("Victoria Park", 43.263, -79.884, "map3");
  parkMap("Gage Park", 43.241, -79.83, "map4");
  // Map Results -> 1 map, 4 markers
  parkMap(parkName, latitude, longitude, "mapResultsMap");
}

// LeafletJS and OpenStreetMap function
function parkMap(parkDescription, coordinate_x, coordinate_y, name) {
  // Draw map w/ coordinates
  var map = L.map(name).setView([coordinate_x, coordinate_y], 15);

  // Set layers of the map and min/max zoom
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
    minZoom: 1
  }).addTo(map);

  // On small screens, make attribution text smaller
  if ($(window).width() <= 500) {
    $(".leaflet-control-attribution").css({
      fontSize: 5.5
    });
  }

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

// Adding marker on a map function
function addMarker(map, x, y, description) {
  L.marker([x, y])
    .addTo(map)
    .bindPopup(description);
}
