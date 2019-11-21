<?php 
    require "header.php";
?>

   <!-- Centered main-->
   <main class="main">
      <!-- Breadcrum: Navigation -->
      <div class="breadcrumb" role="navigation">
        <ul>
          <li>
            <a href="./index.html">Home</a>
          </li>
          <li>></li>
          <li>
            <a href="./registration.html">Sign Up</a>
          </li>
        </ul>
      </div>

      <form
        name="register-form"
        id="register-form"
        action="includes/registration.inc.php"
        method="post"
        onsubmit="return validateForm()"
      >

      <?php
      // Registration errors
        if(isset($_GET['error'])){
            if($_GET['error'] == "emptyfields"){
                echo '<p class=registrationError>Username, email or password fields are empty.</p>';
            }
            else if($_GET['error'] == "invalidusernameemail"){
                echo '<p class=registrationError>Username and email are invalid.</p>';
            }
        }
        // Successfully registered
        else if(isset($_GET['registration']) == "success"){
            echo '<p class=registrationSuccess>Sign up successful!</p>';
        }
      ?>
        <!--Input for username, type=text-->
        <div>
          <p>*Username:</p>
          <input
            type="text"
            name="user-name"
            id="username"
            pattern="^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$"
            title="Only letters, numbers and -_!&*()' characters. Max length is 20."
            maxlength="20"
            required
          />
          <p id="usernameError" class="error"></p>
        </div>

        <!--Input for email address, type=email-->
        <div>
          <p>*Email:</p>
          <input
            type="email"
            name="user-email"
            id="userEmail"
            pattern="[^@]+@[^\.]+\..+"
            title="Please use a proper email address. Max length is 50."
            maxlength="50"
            required
          />
          <p id="emailError" class="error"></p>
        </div>

        <!--Input for user password, type=password-->
        <div>
          <p>*Password:</p>
          <!--At least one lowercase, a uppercase, a number, special character and length between 8 to 15-->
          <input
            type="password"
            name="user-password"
            id="userPassword"
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_=+!@#$%^&*()]).{8,15}$"
            title="At least an uppercase, a lowercase, a number, a special character -_=+!@#$%^&*() and length of 8-15"
            required
          />
          <p id="passwordError" class="error"></p>
        </div>

        <!--Input for user city, type=text-->
        <div>
          <p>Current City:</p>
          <input
            type="text"
            name="user-city"
            id="userCity"
            pattern="^([a-zA-Z0-9]+[-&']*)+$"
            title="Please only use letters, numbers and -&' characters. Max length is 50."
            maxlength="50"
          />
          <p id="cityError" class="error"></p>
        </div>

        <!--Input for user phone number, type=tel-->
        <div>
          <p>Phone:</p>
          <input
            type="tel"
            name="user-phone"
            id="userPhone"
            pattern="^[+]{0,1}[0-9\s]{0,4}[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$"
            title="Examples: 9998887766, 999 888 77 66, +1 (999) 888 77 66, ..."
            maxlength="20"
          />
          <p id="phoneError" class="error"></p>
        </div>

        <hr />

        <!--Input for frequency, type=radio-->
        <div>
          <p>How often do you visit parks?</p>

          <!--Flex box for 3 rows-->
          <div class="flexContainer radioFlex">
            <!--First grid div for # of days-->
            <div class="gridContainer flexDiv1">
              <p class="daysValues">1-2</p>
              <input type="radio" name="days" id="1to2" />
              <p>3-4</p>
              <input type="radio" name="days" id="3to4" />
              <p>5-6</p>
              <input type="radio" name="days" id="5to6" />
              <p>7+</p>
              <input type="radio" name="days" id="7plus" />
            </div>
            <!--Second grid div for "in a"-->
            <div class="flexDiv2">
              <p>in a</p>
            </div>
            <!--Third grid div for period-->
            <div class="gridContainer flexDiv3">
              <p>week</p>
              <input type="radio" name="period" id="week" />
              <p>month</p>
              <input type="radio" name="period" id="month" />
              <p>session</p>
              <input type="radio" name="period" id="session" />
              <p>year</p>
              <input type="radio" name="period" id="year" />
            </div>
          </div>
        </div>

        <hr />

        <!--Input for terms&conditions, type=checkbox-->
        <div class="flexContainer checkboxFlex">
          <input
            type="checkbox"
            name="terms-and-privacy"
            id="termsAndPrivacy"
            required
            aria-checked="false"
          />
          <p class="termsAndPrivacyText">
            I read and acceptted
            <a href="https://www.google.com/search?q=terms+%26+conditions"
              >Terms&Conditions</a
            >
            and
            <a href="https://www.google.com/search?q=privacy+policy"
              >Privacy Policy</a
            >
            of ParkRater.
          </p>
          <p id="termsAndPrivacyErrror" class="error"></p>
        </div>

        <hr />

        <!--Input for form reset, type=reset-->
        <div>
          <input
            type="reset"
            value="Reset"
            class="resetButton"
            aria-pressed="false"
          />
          <!--Input for submitting the form, type=submit-->
          <input
            type="submit"
            value="Submit"
            class="submitButton"
            aria-pressed="false"
          />
        </div>
      </form>
      <br /><br />
    </main>


<?php
    require "footer.php";
?>