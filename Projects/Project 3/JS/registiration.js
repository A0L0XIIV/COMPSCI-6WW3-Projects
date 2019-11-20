// Init function
window.onload = init;

// Global variables
var form;
var username;
var email;
var password;
var city;
var phone;
var termsAndPrivacy;
var usernameError;
var emailError;
var passwordError;
var cityError;
var phoneError;
var termsAndPrivacyErrror;

// Assign global variables in init function
function init() {
  // Get form inputs by name
  form = document.forms["registerForm"];
  username = document.forms["registerForm"]["username"];
  email = document.forms["registerForm"]["userEmail"];
  password = document.forms["registerForm"]["userPassword"];
  city = document.forms["registerForm"]["userCity"];
  phone = document.forms["registerForm"]["userPhone"];
  termsAndPrivacy = document.forms["registerForm"]["termsAndPrivacy"];
  // Get error panels by name
  usernameError = document.forms["registerForm"]["usernameError"];
  emailError = document.forms["registerForm"]["emailError"];
  passwordError = document.forms["registerForm"]["passwordError"];
  cityError = document.forms["registerForm"]["cityError"];
  phoneError = document.forms["registerForm"]["phoneError"];
  termsAndPrivacyErrror =
    document.forms["registerForm"]["termsAndPrivacyErrror"];
}

// Check required inputs for empty values
function emptyCheck() {
  if (username.value === "" || username.value == null) {
    alert("Username cannot be empty!");
    usernameError.innerHTML("Username cannot be empty!");
    return false;
  }
  if (email.value === "" || email.value == null) {
    alert("Email cannot be empty!");
    emailError.innerHTML("Email cannot be empty!");
    return false;
  }
  if (password.value === "" || password.value == null) {
    alert("Password cannot be empty!");
    passwordError.innerHTML("Password cannot be empty!");
    return false;
  }
  return true;
}

// Terms & Privacy check -> Should be check in order to submit
function termsAndPrivacyCheck() {
  if (termsAndPrivacy.value === false) {
    alert("Please read an accept the Terms&Privicy.");
    termsAndPrivacyErrror.innerHTML("Please read an accept the Terms&Privicy.");
    return false;
  } else {
    return true;
  }
}

// Email validation and error messages
function validateEmail() {
  // New pattern for emails
  var emailPattern = new RegExp(
    "^[A-Za-z0-9_]+([.-]?[A-Za-z0-9_]+)*@[A-Za-z0-9_]+([.-]?[A-Za-z0-9_]+)*(.[A-Za-z0-9_]{2,3})+$"
  );
  // Return its comparision result and show the errors
  if (emailPattern.test(email.value)) {
    return true;
  } else {
    alert("Email doesn't seem right. Please check it again.");
    emailError.innerHTML("Email doesn't seem right. Please check it again.");
    return false;
  }
}

// Password validation and error messages
function validatePassword() {
  // New pattern for passwords
  // lowercase, uppercase, digit, special char. and length:8-15
  var passwordPattern = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[-_=+!@#$%^&*()]).{8,15}$"
  );
  // Return its comparision result and show the errors
  if (passwordPattern.test(password.value)) {
    return true;
  } else {
    alert(
      "Password doesn't fit the pattern. At least 1 lowercase, 1 uppercase, 1 number and one special character."
    );
    passwordError.innerHTML(
      "Password doesn't fit the pattern. At least 1 lowercase, 1 uppercase, 1 number and one special character."
    );
    return false;
  }
}

// Username validation and error messages
function validateUsername() {
  // New pattern for names
  var usernamePattern = new RegExp("^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$");
  // Return its comparision result and show the errors
  if (usernamePattern.test(username.value)) {
    return true;
  } else {
    alert("Username invalid! Please just use letters, numbers and -_!&*()'");
    usernameError.innerHTML("Please just use letters, numbers and -_!&*()'");
    return false;
  }
}

// City name validation and error messages
function validateCity() {
  // Check if city is null or not
  if (city.value === null || city.value === "") return true;
  // New pattern for names
  var cityPattern = new RegExp("^([a-zA-Z0-9]+[-&']*)+$");
  // Return its comparision result and show the errors
  if (cityPattern.test(city.value)) {
    return true;
  } else {
    alert("City name invalid! Please just use letters, numbers and -&'");
    cityError.innerHTML("Please just use letters, numbers and -&'");
    return false;
  }
}

// Phone validation and error messages
function validatePhone() {
  // Check if city is null or not
  if (phone.value === null || phone.value === "") return true;
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
  if (phonePattern.test(phone.value)) {
    return true;
  } else {
    alert("Phone number doesn't seem right. Please try again.");
    phoneError.innerHTML("Phone number doesn't seem right. Please try again.");
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
      validateUsername() &&
      validateCity() &&
      validatePhone() &&
      termsAndPrivacyCheck()
    ) {
      alert("Form is valid!");
    } else {
      alert("Form is NOT valid!");
    }
  }
}
