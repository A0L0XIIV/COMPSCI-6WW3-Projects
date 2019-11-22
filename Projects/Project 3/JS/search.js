// Init function
window.onload = init;
// Global error variable
var locationError;

// Assign error variable with jQuery ID
function init() {
  locationError = $("#locationError");
}

// Geolocation API call
function getLocation() {
  // If Geolocation is available
  if (navigator.geolocation) {
    locationError.text("Locating...");
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    locationError.text("Geolocation is not supported by this browser.");
  }
}

// Alerts coordinates
function showPosition(position) {
  var latitude = position.coords.latitude.toFixed(5);
  var longitude = position.coords.longitude.toFixed(5);

  // This part used in submission page
  // They fill the input values
  var parkLatitude = document.getElementById("parkLatitude");
  if (parkLatitude) parkLatitude.value = latitude;
  var parkLongitude = document.getElementById("parkLongitude");
  if (parkLongitude) parkLongitude.value = longitude;

  locationError.text("");
  //alert("Latitude: " + latitude + "\nLongitude: " + longitude);
}

// Shows different error types
function showError(error) {
  switch (error.code) {
    // User doesn't give permission for location
    case error.PERMISSION_DENIED:
      locationError.text("User denied the request for Geolocation.");
      break;
    // Cannot get the location of the user
    case error.POSITION_UNAVAILABLE:
      locationError.text("Location information is unavailable.");
      break;
    // Connection timed out
    case error.TIMEOUT:
      locationError.text("The request to get user location timed out.");
      break;
    // Other errors
    case error.UNKNOWN_ERROR:
      locationError.text("An unknown error occurred.");
      break;
  }
}
