<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS libraries: Bootstrap CSS, Font Avesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS stylesheets -->
    <link rel="stylesheet" type="text/css" href="../CSS/main.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/individual_sample.css" />

    <?php
    require "stylesheets.php";
?>

    <!-- JS libraries: jQuery, Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- JS stylesheets -->
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../JS/individual_sample.js"></script>

    <!-- LeafletJS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
    <!-- LeafletJS JavaScript -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>

    <!-- Title of the page -->
    <title>ParkRater</title>
    <!-- IPhone adding to home screen -->
    <link rel="apple-touch-icon" href="../Images/Logos/LogoSmall.png" />
    <link rel="apple-touch-startup-image" href="../Images/Logos/Logo.png" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 1" />
    <!-- Favicon for homescreens -->
    <link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <link rel="mask-icon" href="../safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2fa22b">
    <meta name="theme-color" content="#ffffff">


    <!-- Twitter Cards Metadata-->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@parkrater" />

    <!-- Open Graph Metadata -->
    <meta property="og:title" content="Highland Garden's Park" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.parkrater.com/park/abc123/" />
    <!--Open Graph image properties -->
    <meta property="og:image" content="http://www.parkrater.com/park/abc123/images/abc123img123.jpg" />
    <meta property="og:image:secure_url" content="https://www.parkrater.com/park/abc123/images/abc123img123.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Picture of the park" />
    <!-- Open Grah other properties -->
    <meta property="og:description" content="Highland Garden's Park, Hamilton, ON, Canada" />
    <meta property="og:determiner" content="" />
    <meta property="og:site_name" content="ParkRater" />
</head>
<body>
    <header class="flexContainer">
        <!-- Site Logo w/ index.html link-->
        <div class="headerFlexItemLogo" id="headerLogoDiv">
            <a href="./index.php">
                <picture id="websiteLogo">
                    <source media="(min-width: 800px)" id="websiteLogoBig" srcset="../Images/Logos/Logo.png">
                    <img src="../Images/Logos/LogoSmall.png" alt="ParkRater Logo" id="websiteLogoSmall" aria-label="ParkRater Logo">
                </picture>
            </a>
        </div>

        <!-- Center div of the header: Name of the website and navbar -->
        <div class="headerFlexItemNav" id="headerNavDiv">
            <!-- Website name -->
            <div class="headerSiteName" id="websiteName">
                <a href="./index.php">ParkRater</a>
            </div>

            <!-- Navbar and its linked buttons -->
            <nav class="gridContainer">
                <!-- <form action="./result_sample.html" class="navButton">
                    <input type="submit" value="Results" aria-pressed="false"/>
                </form>
                <form action="./individual_sample.html" class="navButton">
                    <input type="submit" value="Individual" aria-pressed="false"/>
                </form> -->
                <form action="./individual_sample.php" class="navButton">
                    <input type="submit" value="Random Park" aria-pressed="false"/>
                </form>
                <form action="./search.php" class="navButton">
                    <input type="submit" value="Search Parks" aria-pressed="false"/>
                </form>
                <form action="./submission.php" class="navButton">
                    <input type="submit" value="New Park" aria-pressed="false"/>
                </form>
                <?php
                    if(isset($_SESSION['userId'])){
                        echo '                <form action="./logout.php" class="navButton">
                        <input type="submit" value="Logout" aria-pressed="false"/>
                    </form>';
                    }
                    else{
                        echo '<form action="./registration.php" class="navButton">
                        <input type="submit" value="Sign Up" aria-pressed="false"/>
                    </form>
                    <form action="./login.php" class="navButton">
                        <input type="submit" value="Login" aria-pressed="false"/>
                    </form>';
                    }
                ?> 
            </nav>
        </div>

        <!-- Search bars -->
        <div class="headerFlexItemSearch gridContainer" id="headerSearchDiv" role="search">
            <div></div>
            <!-- Search bar and its button -->
            <div class="searchWithName">
                <input type="search" name="searchBox" class="searchBox" placeholder=" Enter park name">
                <button class="searchButton" aria-pressed="false">Search</button>
            </div>
            <!-- Search w/ rating dropdown and its button -->
            <div class="searchWithRate">
                <select>
                    <option value="" hidden selected>Select rating</option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <button class="searchButton" aria-pressed="false">Search</button>
            </div>
        </div>
    </header>
