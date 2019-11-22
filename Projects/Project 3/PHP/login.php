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
            <a href="./login.php">Sign In</a>
          </li>
        </ul>
      </div>

      <form
        name="login-form"
        id="login-form"
        action="includes/login.inc.php"
        method="post"
        onsubmit="return validateForm()"
      >
        <!--Input for username, type=text-->
        <div>
          <p>Username or Email address:</p>
          <input
            type="text"
            name="email-username"
            id="email-username"
            title="Max length is 50."
            maxlength="50"
            placeholder="Username/Email..."
            required
          />
          <p id="usernameError" class="error"></p>
        </div>

        <!--Input for user password, type=password-->
        <div>
          <p>Password:</p>
          <input
            type="password"
            name="user-password"
            id="userPassword"
            placeholder="Password..."
            required
          />
          <p id="passwordError" class="error"></p>
        </div>

        <div>
        <?php
            // Login error
            if(isset($_GET['error']) && $_GET['error'] == "autherror"){
                echo '<p class="error">Username/Email and/or Password are incorrect!</p>';
            }
            // Successfully registered
            else if(isset($_GET['login']) && $_GET['login'] == "success"){
                echo '<p class="success">Welcome '.$_SESSION['username'].'!</p>';
            }
        ?>
        </div>

          <!--Input for submitting the form, type=submit-->
        <div>
          <input
            type="submit"
            value="Submit"
            name="login-submit"
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