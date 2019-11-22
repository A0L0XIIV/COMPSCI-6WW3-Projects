<?php
if(isset($_POST['park-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';
    // Get field values from post request
    $parkName = $_POST['park-name'];
    $parkDescription = $_POST['park-description'];
    $parkLatitude = $_POST['park-latitude'];
    $parkLongitude = $_POST['park-longitude'];
    $parkCountry = $_POST['park-country'];
    $parkRegion = $_POST['park-region'];
    $parkCity = $_POST['park-city'];
    $parkAddress = $_POST['park-address'];
    $parkPostal = $_POST['park-postal_code'];
    $parkImages = $_POST['park-images'];
    $parkVideos = $_POST['park-videos'];

    // Empty field check
    if(empty($parkName) || empty($parkLatitude)|| empty($parkLongitude)){
        header("Location: ../submission.php?error=emptyfields&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }    
    // Park name regex check
    else if(!preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkName)){
        header("Location: ../submission.php?error=invalidparkname&parkName=&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Latitude regex check
    else if(!preg_match("/^([-]?[0-9]{1,2}\.[0-9]{3,7})$/", $parkLatitude)){
        header("Location: ../submission.php?error=invalidlatitude&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Longitude regex check
    else if(!preg_match("/^([-]?[0-9]{1,2}\.[0-9]{3,7})$/", $parkLongitude)){
        header("Location: ../submission.php?error=invalidlongitude&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Country regex check
    else if(!empty($parkCountry) && !preg_match("/[a-zA-Z ]{2,}/", $parkCountry)){
        header("Location: ../submission.php?error=invalidcountry&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Region regex check
    else if(!empty($parkRegion) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkRegion)){
        header("Location: ../submission.php?error=invalidregion&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=
        &parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // City regex check
    else if(!empty($parkCity) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkCity)){
        header("Location: ../submission.php?error=invalidcity&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Address regex check
    else if(!empty($parkAddress) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkAddress)){
        header("Location: ../submission.php?error=invalidaddress&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=&parkPostal=".$parkPostal);
        exit();
    }
    // Postal code regex check
    else if(!empty($parkPostal) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkPostal)){
        header("Location: ../submission.php?error=invalidpostal&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=");
        exit();
    }
    // Every fields OK
    else{
        // Check if park name is already in DB or not
        $sql = "SELECT * FROM park WHERE name=?";// ? because sql injection
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../submission.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $parkName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Check if username is taken or not
            if($resultCheck > 0){
                header("Location: ../submission.php?error=parkexist");
                exit();
            }
            else{
                // Save user into DB
                $sql = "INSERT INTO park (name, description, latitude, longitude, country, region, city, address, postal_code) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"; // ADD IMAGE AND VIDEO!!!!!!!!!!!!!!!!!
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../submission.php?error=sqlerror");
                    exit();
                }
                else{
                    // Execute sql statement
                    mysqli_stmt_bind_param($stmt, "ssddsssss", $parkName, $parkDescription, $parkLatitude, $parkLongitude,
                                            $parkCountry, $parkRegion, $parkCity, $parkAddress, $parkPostal);
                    mysqli_stmt_execute($stmt);
                    // Return success
                    header("Location: ../submission.php?submission=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
// If the request coming from outside of the regitration page's form
else{
    header("Location: ../submission.php");
    exit();
}