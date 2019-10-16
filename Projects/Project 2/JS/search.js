window.onload = init;
var locationError;

function init() {
  locationError = $("#locationError");
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    locationError.text("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  alert(
    "Latitude: " +
      position.coords.latitude +
      "Longitude: " +
      position.coords.longitude
  );
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      locationError.text("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      locationError.text("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      locationError.text("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      locationError.text("An unknown error occurred.");
      break;
  }
}
