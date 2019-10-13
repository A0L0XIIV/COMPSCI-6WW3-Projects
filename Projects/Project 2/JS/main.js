function validateEmail(phone) {
  /*9055259140
905 525 9140
(905) 525 9140
(905) 525 -9140
+1 (905) 525 -9140*/
}

function validatePassword(password) {
  var passwordPattern = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*d)(?=.*[-_=+!@#$%^&*()]).{8,15}$"
  );
  return passwordPattern.test(password);
}

function validateName(name) {
  var namePattern = new RegExp("");
}

function validateParkName(parkName) {}
