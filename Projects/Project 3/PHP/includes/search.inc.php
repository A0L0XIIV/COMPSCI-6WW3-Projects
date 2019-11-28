<?php
// Search parks with park name
if(isset($_POST['name-search-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    // Get park name form the search page with park-name
    $parkName = $_POST['park-name'];

    // Empty field check
    if(empty($parkName)){
        header("Location: ../search.php?error=emptyfield");
        exit();
    }    
    // Not empty
    else{
        // Get all park ids with similar to user's input (LIKE)
        $sql = "SELECT park_id FROM park WHERE park_name LIKE ?";// ? because sql injection
        $stmt = mysqli_stmt_init($conn);
        // Prepare the DB for query
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            // Preparing the park name for LIKE query 
            $param = '%'.$parkName.'%';
            // Bind param into sql statement
            mysqli_stmt_bind_param($stmt, "s", $param);
            // Call sql execution and result handling function 
            sqlExeAndResult($stmt);
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}

// Search parks with park rank
else if(isset($_POST['rating-search-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    // Get park rating form the search page with park-rating
    $parkRating = $_POST['park-rating'];

    // Empty field check
    if(empty($parkRating)){
        header("Location: ../search.php?error=emptyfield");
        exit();
    }    
    // Not empty
    else{
        // Search parks with review rate --> park and review join
        $sql = "SELECT park.park_id FROM park INNER JOIN review ON park.park_id=review.park_id WHERE review.rating=?";// ? because sql injection
        $stmt = mysqli_stmt_init($conn);
        // Prepare the DB for query
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            // Bind param into sql statement
            mysqli_stmt_bind_param($stmt, "i", $parkRating);
            // Call sql execution and result handling function 
            sqlExeAndResult($stmt);
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Search parks with park location
else if(isset($_POST['location-search-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    // Get park latitude and longitude form the search page with park-latitude and park-longitude
    $parkLatitude = $_POST['park-latitude'];
    $parkLongitude = $_POST['park-longitude'];
    $maxParkLatitude = $parkLatitude + 0.02;
    $minParkLatitude = $parkLatitude - 0.02;
    $maxParkLongitude = $parkLongitude + 0.02;
    $minParkLongitude = $parkLongitude - 0.02;

    // Empty field check
    if(empty($parkLatitude) || empty($parkLongitude)){
        header("Location: ../search.php?error=emptyfield");
        exit();
    }
    // Not empty
    else{
        // Search between 0.02 latitude and longitude
        $sql = "SELECT park_id FROM park WHERE ? > latitude AND latitude > ? AND ? > longitude AND longitude > ?";
        $stmt = mysqli_stmt_init($conn);
        // Prepare the DB for query
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../search.php?error=sqlerror");
            exit();
        }
        else{
            // Bind param into sql statement
            mysqli_stmt_bind_param($stmt, "dddd", $maxParkLatitude, $minParkLatitude, $maxParkLongitude, $minParkLongitude);
            // Call sql execution and result handling function 
            sqlExeAndResult($stmt);
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

// This part is common for all types of searches therefore, it is a seperate function
function sqlExeAndResult($stmt){
    // Execute the sql query
    mysqli_stmt_execute($stmt);
    // Bind result variables
    mysqli_stmt_bind_result($stmt, $result);
    // Store results
    if(mysqli_stmt_store_result($stmt)){
        // Check if DB returned any park
        if(mysqli_stmt_num_rows($stmt) > 0){
            $parkIds = NULL;
            // Fetch values
            while (mysqli_stmt_fetch($stmt)) {
                // Concatenate the park Ids' with comma
                $parkIds = $parkIds.$result.",";
            }
            // For passing multiple park ids --> comma between them and delete the last comma
            $parkIds = rtrim($parkIds, ", ");
            // Redirect to results page with the park ids
            header("Location: ../result_sample.php?get-results&result=".$parkIds);
            exit();
        }
        // No park found with user's search criterias
        else{
            header("Location: ../search.php?error=noparkfound");
            exit();
        }
    }
    // mysqli_stmt_store_result error
    else{
        header("Location: ../search.php?error=sqlerror");
        exit();
    }
}