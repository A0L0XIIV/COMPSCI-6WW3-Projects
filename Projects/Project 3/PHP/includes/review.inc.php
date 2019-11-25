<?php
if(isset($_POST['review-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';
    require '../head.php';

    $reviewRating = $_POST['review-rating'];
    $reviewContent = $_POST['review-content'];
    $parkId = $_POST['park-id'];
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];

    // Empty fields check
    if(empty($reviewRating) || empty($parkId)){
        header("Location: ../error.php?error=emptyfields");
        exit();
    }       
    // Empty fields for session variables
    else if(empty($username) || empty($userId)){
        header("Location: ../error.php?error=notlogin");
        exit();
    }     
    // Every fields OK
    else{
        // ? because sql injection
        $sql = "SELECT review_id FROM review WHERE user_id=? AND park_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../error.php?error=sqlerror");
            exit();
        }
        else{
            // Bind user id and park id parameter into sql query
            mysqli_stmt_bind_param($stmt, "ii", $userId, $parkId);
            // Execute sql query
            mysqli_stmt_execute($stmt);
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $reviewId);
            // Store results
            if(mysqli_stmt_store_result($stmt)){
                // Check if DB returned any review from the same user
                if(mysqli_stmt_num_rows($stmt) > 0){
                    // User already reviewed the same park
                    header("Location: ../error.php?error=parkreviewed");
                    exit();
                }
                // No review found with park id
                else{
                    // Save review into DB
                    $sql = "INSERT INTO review (content, rating, user_id, park_id) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../error.php?error=sqlerror");
                        exit();
                    }
                    else{
                        // Bind parameters into query
                        mysqli_stmt_bind_param($stmt, "siii", $reviewContent, $reviewRating, $userId, $parkId);
                        // Execute sql statement
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $result);
                        mysqli_stmt_store_result($stmt);
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            header("Location: ../error.php?error=sqlerror");
                            exit();
                        }else{
                            // Return success
                            header("Location: ../error.php?success=reviewsubmission");
                            exit();
                        }
                    }
                }
            }
            // mysqli_stmt_store_result error
            else{
                header("Location: ../error.php?error=sqlerror");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
// If the request coming from outside of the regitration page's form
else{
    header("Location: ../error.php?error=unauthorized");
    exit();
}