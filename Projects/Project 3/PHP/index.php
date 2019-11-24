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
        </ul>
    </div>
    
    <h1>Welcome to the ParkRater
        <?php
            // Successfully registered
            if(isset($_GET['login']) && $_GET['login'] == "success"){
                echo ' '.$_SESSION['username'].'!</p>';
            }
        ?>
    </h1>
    <p>You can browse world wide parks in there.</p>
    <p>Also if your park isn't in there, you can 
        <a href="./submission.php">add</a> 
        it!
    </p>

</main>

<?php
    require "footer.php";
?>