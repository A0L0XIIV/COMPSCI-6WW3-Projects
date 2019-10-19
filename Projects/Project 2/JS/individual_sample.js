// Init function -> body calls it
function init() {
  // Set dynamic variables in init function
  var parkName = "Highland Garden's Park";

  var coordinate_x = 43.245557;
  var coordinate_y = -79.8922284;

  // Load maps
  parkMap(parkName, coordinate_x, coordinate_y);

  // Use jQuery text function to escape HTML
  $(".parkName").text("Highland Garden's Park");
  $("#latitude").text(coordinate_x);
  $("#longitude").text(coordinate_y);
  $("#addressCountry").text("Canada");
  $("#addressRegion").text("ON");
  $("#addressLocality").text("Hamilton");
  $("#streetAddress").text("1 Hillcrest Avenue");
  $("#postalCode").text("L8P 2X3");
}

// LeafletJS and OpenStreetMap function
function parkMap(parkName, coordinate_x, coordinate_y) {
  // Set map coordinates and zoom (15)
  var map = L.map("map").setView([coordinate_x, coordinate_y], 15);

  // Set layers of the map and min/max zoom
  L.tileLayer("https:/a.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18,
    minZoom: 1
  }).addTo(map);

  // Put park's marker on map
  L.marker([coordinate_x, coordinate_y])
    .addTo(map)
    .bindPopup(parkName);
}
