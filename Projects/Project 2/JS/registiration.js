// Init function
window.onload = init;

// Global variables
const form;
const username;
const email;
const password;
const city;
const phone;
const termsAndPrivacy;
const usernameError;
const emailError;
const passwordError;
const cityError;
const phoneError;
const termsAndPrivacyErrror;

// Declare global variables in init function
function init() {
    // Get inputs by id
    form = $("#registerForm");
    username = $("#username");
    email = $("#userEmail");
    password = $("#userPassword");
    city = $("#userCity");
    phone = $("#userPhone");
    termsAndPrivacy = $("#termsAndPrivacy");
    // Get error panels by id
    usernameError = $("#usernameError");
    emailError = $("#emailError");
    passwordError = $("#passwordError");
    cityError = $("#cityError");
    phoneError = $("#phoneError");
    termsAndPrivacyErrror = $("#termsAndPrivacyErrror");
}

// Check required inputs for empty values
function emptyCheck() {
  if (username.value === "" || username.value == null) {
    usernameError.text("Username cannot be empty!");
    return false;
  }
  if (email.value === "" || email.value == null) {
    emailError.text("Email cannot be empty!");
    return false;
  }
  if (password.value === "" || password.value == null) {
    passwordError.text("Password cannot be empty!");
    return false;
  }
  return true;
}

// Terms & Privacy check -> Should be check in order to submit
function termsAndPrivacyCheck() {
  if (termsAndPrivacy.value === false) {
    termsAndPrivacyErrror.text("Please read an accept the Terms&Privicy.");
    return false;
  } else {
    return true;
  }
}

// Email validation and error messages
function validateEmail() {
  // New pattern for emails
  var emailPattern = new RegExp("/^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/");
  // Return its comparision result and show the errors
  if (emailPattern.test(email)) {
    return true;
  } else {
    emailError.text("Email doesn't seem right. Please check it again.");
    return false;
  }
}

// Password validation and error messages
function validatePassword() {
  // New pattern for passwords
  // lowercase, uppercase, digit, special char. and length:8-15
  var passwordPattern = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*d)(?=.*[-_=+!@#$%^&*()]).{8,15}$"
  );
  // Return its comparision result and show the errors
  if (passwordPattern.test(password)) {
    return true;
  } else {
    passwordError.text(
      "Password doesn't fit the pattern. At least 1 lowercase, 1 uppercase, 1 number and one special character."
    );
    return false;
  }
}

// Username and city validation and error messages
function validateName(name, isUsername) {
  // New pattern for names
  var namePattern = new RegExp("^([-_!&*()']*[a-zA-z0-9]+[-_!&*()']*)+$");
  // Return its comparision result and show the errors
  if (namePattern.test(name)) {
    return true;
  } else {
    // This function called with both username and city name
    if (isUsername) {
      usernameError.text("Please just use letters, numbers and -_!&*()'");
    } else {
      cityError.text("Please just use letters, numbers and -&'");
    }
    return false;
  }
}

// Phone validation and error messages
function validatePhone() {
  /*9055259140
  905 525 9140
  (905) 525 9140
  (905) 525 -9140
  +1 (905) 525 -9140*/
  // New pattern for phone
  var phonePattern = new RegExp(
    "^[+]{0,1}[0-9s]{0,4}[(]{0,1}[0-9]{1,4}[)]{0,1}[-s./0-9]*$"
  );
  // Return its comparision result and show the errors
  if (phonePattern.test(phone)) {
    return true;
  } else {
    phoneError.text("Phone number doesn't seem right. Please try again.");
    return false;
  }
}

// Validate all form data
function validateForm() {
  if (form) {
    // Required validations
    if (
      emptyCheck() &&
      validateEmail() &&
      validatePassword() &&
      validateName(username, true) &&
      validateName(city, false) &&
      validatePhone() &&
      termsAndPrivacyCheck()
    ) {
      alert("OK");
    } else {
      alert("NOT OK");
    }
  }
}
