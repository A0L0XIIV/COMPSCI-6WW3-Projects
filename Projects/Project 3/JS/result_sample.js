// Init function -> body calls it
function init() {
  var i = 0;
  var parkIds = [];
  var parkNames = [];
  var parkLatitudes = [];
  var parkLongitudes = [];
  // Loop over each result
  while ($("#map" + i).length) {
    // Get park name, latitude and longitude values
    var parkId = $("#parkId" + i).text();
    var parkName = $("#parkName" + i).text();
    var latitude = $("#latitude" + i).text();
    var longitude = $("#longitude" + i).text();
    // Load Tabular results' maps with mapId
    parkMap(parkName, latitude, longitude, "map" + i);
    i++;
    // Push values for one map result tab
    parkIds.push(parkId);
    parkNames.push(parkName);
    parkLatitudes.push(latitude);
    parkLongitudes.push(longitude);
  }

  // Map Results -> 1 map, 4 markers
  parksMap(parkIds, parkNames, parkLatitudes, parkLongitudes, "mapResultsMap");
}

// LeafletJS and OpenStreetMap function
// Tabular Results page function
function parkMap(parkName, coordinate_x, coordinate_y, mapId) {
  // Draw map w/ coordinates
  var map = L.map(mapId).setView([coordinate_x, coordinate_y], 15);

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
  addMarker(map, coordinate_x, coordinate_y, parkName);

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

// Map Results page function
function parksMap(parkIds, parkNames, parkLatitudes, parkLongitudes, mapId) {
  // Draw map w/ coordinates
  var map = L.map(mapId).setView([parkLatitudes[0], parkLongitudes[0]], 15);

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

  // Add markers on map
  for (var i = 0; parkNames[i]; i++) {
    var link =
      "<a href='../PHP/individual_sample.php?get-park&id=" +
      parkIds[i] +
      "'>" +
      parkNames[i] +
      "</a>";
    addMarker(map, parkLatitudes[i], parkLongitudes[i], link);
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
