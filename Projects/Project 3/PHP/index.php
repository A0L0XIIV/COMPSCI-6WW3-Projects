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

    <h1>Welcome to the ParkRater</h1>
    <p>You can browse world wide parks in there.</p>
    <p>Also if your park isn't in there, you can add it!</p>
    <?php
        if(isset($_SESSION['userId'])){
            echo '<p>You are logged in!</p>';
        }
        else{
            echo '<p>You are logged out!</p>';
        }
    ?> 
</main>

<?php
    require "footer.php";
?>