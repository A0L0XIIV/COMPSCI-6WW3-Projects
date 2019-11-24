<?php
if(isset($_POST['review-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    $reviewRating = $_POST['review-rating'];
    $reviewContent = $_POST['review-content'];
    $parkId = $_POST['park-id'];
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];

    // Empty field check
    if(empty($reviewRating) || empty($reviewContent) || empty($parkName) || empty($username)){
        header("Location: ../individual_sample.php?error=emptyfields&reviewRating=".$reviewRating."&reviewContent=".$reviewContent);
        exit();
    }    
    // Every fields OK
    else{
        // ? because sql injection
        $sql = "SELECT review_id FROM review WHERE user_id=? AND park_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../individual_sample.php?error=sqlerror");
            exit();
        }
        else{
            // Bind user id and park id parameter into sql query
            mysqli_stmt_bind_param($stmt, "ii", $userId, $parkId);
            // Execute sql query
            mysqli_stmt_execute($stmt);

            // mysqli_stmt_store_result($stmt);
            // $resultCheck = mysqli_stmt_num_rows($stmt);
            // // Check if user already reviewed this park or didn't
            // if($resultCheck > 0){
            //     header("Location: ../individual_sample.php?error=parkreviewed");
            //     exit();
            // }
            // else{
            //     // Save review into DB
            //     $sql = "INSERT INTO review (content, rating, user_id, park_id) VALUES (?, ?, ?, ?)";
            //     $stmt = mysqli_stmt_init($conn);
            //     if(!mysqli_stmt_prepare($stmt, $sql)){
            //         header("Location: ../individual_sample.php?error=sqlerror");
            //         exit();
            //     }
            //     else{
            //         // Execute sql statement
            //         mysqli_stmt_bind_param($stmt, "siii", $reviewContent, $reviewRating, $userId, $parkId);
            //         mysqli_stmt_execute($stmt);
            //         // Return success
            //         header("Location: ../individual_sample.php?reviewsubmission=success");
            //         exit();
            //     }
            // }

            // Bind result variables
            mysqli_stmt_bind_result($stmt, $reviewId);
            // Store results
            if(mysqli_stmt_store_result($stmt)){
                // Check if DB returned any review from the same user
                if(mysqli_stmt_num_rows($stmt) > 0){
                    // User already reviewed the same park
                    header("Location: ../individual_sample.php?error=parkreviewed");
                    exit();
                }
                // No review found with park id
                else{
                    // Save review into DB
                    $sql = "INSERT INTO review (content, rating, user_id, park_id) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../individual_sample.php?error=sqlerror");
                        exit();
                    }
                    else{
                        // Bind parameters into query
                        mysqli_stmt_bind_param($stmt, "siii", $reviewContent, $reviewRating, $userId, $parkId);
                        // Execute sql statement
                        mysqli_stmt_execute($stmt);
                        // Return success
                        header("Location: ../individual_sample.php?reviewsubmission=success");
                        exit();
                    }
                }
            }
            // mysqli_stmt_store_result error
            else{
                header("Location: ../search.php?error=sqlerror");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
// If the request coming from outside of the regitration page's form
else{
    header("Location: ../individual_sample.php");
    exit();
}