<?php 
    require "head.php";
?>
<?php 
    require "header.php";
?>

<!-- Main center div-->
<main class="main">

    <!-- Breadcrum: Navigation -->
    <div class="breadcrumb" role="navigation">
        <ul>
            <li>
                <a href="./index.php">Home</a>
            </li>
            <li> > </li>
            <li>
                Operation Status
            </li>
        </ul>
    </div>
    
    <?php
        // Error
        if(isset($_GET['error'])){
            // Title
            echo '<h1 style="color:red">Error</h1>';
            // Types of errors
            if($_GET['error'] == "notfound"){
                echo '<h2 class="error">Oops. 404!</h2>';
                echo '<h2 class="error">Page not found.</h2>';
            }
            else if($_GET['error'] == "emptyfields"){
                echo '<h2 class="error">Some of the required fields were empty.</h2>';
                echo '<h2 class="error">Please fill all required fields and try again.</h2>';
            }
            else if($_GET['error'] == "sqlerror"){
                echo '<h2 class="error">Oops. Something went wrong!</h2>';
                echo '<h2 class="error">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</h2>';
            }
            // Review error
            else if($_GET['error'] == "parkreviewed"){
                echo '<h2 class="error">You\'ve already reviewed this park.</h2>';
                echo '<h2 class="error">You cannot review the same park more than once.</h2>';
            }
            else if($_GET['error'] == "unauthorized"){
                echo '<h2 class="error">Oops. Something went wrong!</h2>';
                echo '<h2 class="error">Unauthorized access!</h2>';
            }
            else if($_GET['error'] == "notlogin"){
                echo '<h2 class="error">Please login for this operation.</h2>';
            }
        }
        // Success
        else if(isset($_GET['success'])){
            // Title
            echo '<h1 style="color:green">Success</h1>';
            // Types of successes
            if($_GET['success'] == "reviewsubmission"){
                echo '<h2 class="success">Your review added successfully!</h2>';
            }
            
        }
        // Other
        else{
            echo '<h1 class="notFound">Empty Page!</h1>';
        }
    ?>
    <br />

</main>

<?php
    require "footer.php";
?>