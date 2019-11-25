// Init function -> body calls it
function init() {
  // Hide new review div and cancel button on init
  $(".newReview").hide(1);
  $("#hideButton").hide(1);
  $("#showLoginError").hide(1);
  // Set dynamic variables in init function
  var parkName = $(".parkName").text();
  var coordinate_x = $("#latitude").text();
  var coordinate_y = $("#longitude").text();

  // Load maps
  parkMap(parkName, coordinate_x, coordinate_y);
}

// LeafletJS and OpenStreetMap function
function parkMap(parkName, coordinate_x, coordinate_y) {
  // Set map coordinates and zoom (15)
  var map = L.map("map").setView([coordinate_x, coordinate_y], 15);

  // Set layers of the map and min/max zoom
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attributionControl: false,
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

  // Put park's marker on map
  L.marker([coordinate_x, coordinate_y])
    .addTo(map)
    .bindPopup(parkName);
}

// Show new review div and cancel button
function showNewReview() {
  // Get session username
  let sessionUsername = $("#sessionUsername").val();
  // Check if user logged in
  if (sessionUsername !== "") {
    $(".newReview").show(1);
    $("#hideButton").show(1);
    $("#showLoginError").hide(1);
  } else {
    $("#showLoginError").show(1);
    // Not logged in --> Redirect to login page in 2 sec
    setTimeout(function() {
      window.location.href = "login.php";
    }, 2000);
  }
}
// Hide new review div and cancel button
function hideNewReview() {
  $(".newReview").hide(1);
  $("#hideButton").hide(1);
  $("#showLoginError").hide(1);
}
