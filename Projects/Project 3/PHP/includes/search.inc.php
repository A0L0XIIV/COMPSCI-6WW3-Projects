<?php
// Search parks with park name
if(isset($_POST['name-search-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    $parkName = $_POST['search-park-name'];

    // Empty field check
    if(empty($parkName)){
        header("Location: ../search.php?error=emptyfield=name");
        exit();
    }    
    // Not empty
    else{
        // ? because sql injection
        $sql = "SELECT * FROM park WHERE name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $parkName);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt); // MORE THAN ONE RESULT WITH LIKE --> RESULT PAGE
            // Check if username is taken or not
            if($row = mysqli_fetch_assoc($results)){
                // Redirect to results page with the data
                header("Location: ../individual_sample.php?id=".$row['id']);
                exit();
            }
            else{
                header("Location: ../search.php?error=noparkfound");
                exit();
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
// Search parks with park rank
else if(isset($_POST['rank-search-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    $parkRank = $_POST['search-park-rank'];

    // Empty field check
    if(empty($parkRank)){
        header("Location: ../search.php?error=emptyfield=rank");
        exit();
    }    
    // Not empty
    else{
        // ? because sql injection
        $sql = "SELECT * FROM park NATURAL JOIN review WHERE rank=?"; //JOIN SQL PARK-REVIEW
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "i", $parkRank);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);// MORE THAN ONE RESULT --> RESULT PAGE
            // Check if username is taken or not
            if($row = mysqli_fetch_assoc($results)){
                // Redirect to results page with the data
                header("Location: ../individual_sample.php?id=".$row['id']);
                exit();
            }
            else{
                header("Location: ../search.php?error=noparkfound");
                exit();
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
// Search parks with park location
else if(isset($_POST['location-search-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    $parkLatitude = $_POST['search-park-latitude'];
    $parkLongitude = $_POST['search-park-longitude'];
    $maxParkLatitude = $parkLatitude + 0.01;
    $minParkLatitude = $parkLatitude - 0.01;
    $maxParkLongitude = $parkLongitude + 0.01;
    $minParkLongitude = $parkLongitude - 0.01;

    // Empty field check
    if(empty($parkLocation)){
        header("Location: ../search.php?error=emptyfield=location");
        exit();
    }    
    // Not empty
    else{
        // Search between 0.01 latitude and longitude
        $sql = "SELECT * FROM park WHERE ?>latitude>? AND ?>longitude>?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "iiii", $maxParkLatitude, $minParkLatitude, $maxParkLongitude, $minParkLongitude);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            // Check if username is taken or not
            if($row = mysqli_fetch_assoc($results)){
                // Redirect to results page with the data
            }
            else{
                header("Location: ../search.php?error=noparkfound&".$parkLatitude.','.$parkLongitude.','.$maxParkLatitude.','.$minParkLatitude.','.$maxParkLongitude.','.$minParkLongitude);
                exit();
            }
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// If the request coming from outside of the login page's form
else{
    header("Location: ../index.php");
    exit();
}