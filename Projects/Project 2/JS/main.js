function init() {}

function validateEmail(email) {
  // New pattern for emails
  var emailPattern = new RegExp("[^@]+@[^.]+..+");
  // Return its comparision result
  return emailPattern.test(email);
}

function validatePassword(password) {
  // New pattern for passwords
  var passwordPattern = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*d)(?=.*[-_=+!@#$%^&*()]).{8,15}$"
  );
  // Return its comparision result
  return passwordPattern.test(password);
}

function validateName(name) {
  // New pattern for names
  var namePattern = new RegExp("");
  // Return its comparision result
  return namePattern.test(name);
}

function validateParkName(parkName) {}

function validatePhone(phoneNumber) {
  /*9055259140
905 525 9140
(905) 525 9140
(905) 525 -9140
+1 (905) 525 -9140*/
}
