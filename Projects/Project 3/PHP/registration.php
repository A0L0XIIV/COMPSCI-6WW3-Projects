<?php 
    require "head.php";
?>
<?php 
    require "header.php";
?>

   <!-- Centered main-->
   <main class="main">
      <!-- Breadcrum: Navigation -->
      <div class="breadcrumb" role="navigation">
        <ul>
          <li>
            <a href="./index.php">Home</a>
          </li>
          <li>></li>
          <li>
            <a href="./registration.php">Sign Up</a>
          </li>
        </ul>
      </div>

      <form
        name="register-form"
        id="registerForm"
        action="includes/registration.inc.php"
        method="post"
        onsubmit="return validateForm()"
      >

      <?php
        // Successfully registered
        if(isset($_GET['registration']) && $_GET['registration'] == "success"){
            echo '<p class="success">Sign up successful!</p>';
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
            value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>"
            required
          />
          <?php
            if(isset($_GET['error'])){
              // Username error
              if($_GET['error'] == "invalidusername"){
                  echo '<p class="error">Invalid username!</p>';
              }
              // Username and email error
              else if($_GET['error'] == "invalidusernameemail"){
                echo '<p class="error">Invalid username and email address!</p>';
              }
              // Username or email taken
              else if($_GET['error'] == "usertaken"){
                echo '<p class="error">Username or email taken!</p>';
              }
            }
          ?>
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
            value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email'];?>"
            required
          />
          <?php
            // Email error
            if(isset($_GET['error']) && $_GET['error'] == "invalidemail"){
                echo '<p class="error">Invalid email address!</p>';
            }
          ?>
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
          <?php
            // Password error
            if(isset($_GET['error']) && $_GET['error'] == "invalidpassword"){
                echo '<p class="error">Invalid password!</p>';
            }
          ?>
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
            value="<?php if(isset($_REQUEST['city'])) echo $_REQUEST['city'];?>"
          />
          <?php
            // City error
            if(isset($_GET['error']) && $_GET['error'] == "invalidcity"){
                echo '<p class="error">Invalid city name!</p>';
            }
          ?>
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
            value="<?php if(isset($_REQUEST['phone'])) echo $_REQUEST['phone'];?>"
          />
          <?php
            // Phone error
            if(isset($_GET['error']) && $_GET['error'] == "invalidphone"){
                echo '<p class="error">Invalid phone number!</p>';
            }
          ?>
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
              <input type="radio" name="days" value="1" id="1to2" />
              <p>3-4</p>
              <input type="radio" name="days" value="3" id="3to4" />
              <p>5-6</p>
              <input type="radio" name="days" value="5" id="5to6" />
              <p>7+</p>
              <input type="radio" name="days" value="7" id="7plus" />
            </div>
            <!--Second grid div for "in a"-->
            <div class="flexDiv2">
              <p>in a</p>
            </div>
            <!--Third grid div for period-->
            <div class="gridContainer flexDiv3">
              <p>week</p>
              <input type="radio" name="period" value="52" id="week" />
              <p>month</p>
              <input type="radio" name="period" value="12" id="month" />
              <p>session</p>
              <input type="radio" name="period" value="4" id="session" />
              <p>year</p>
              <input type="radio" name="period" value="1" id="year" />
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
            aria-checked="false"
            required
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
            class="cancelButton"
            aria-pressed="false"
          />
          <!--Input for submitting the form, type=submit-->
          <input
            type="submit"
            value="Submit"
            name="register-submit"
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