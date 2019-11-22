<?php
if(isset($_POST['review-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    $reviewRating = $_POST['review-rating'];
    $reviewContent = $_POST['review-content'];
    $parkName = $_POST['park-name'];
    $username = $_SESSION['username'];

    // Empty field check
    if(empty($reviewRating) || empty($reviewContent) || empty($parkName) || empty($username)){
        header("Location: ../individual_sample.php?error=emptyfields&reviewRating=".$reviewRating."&reviewContent=".$reviewContent);
        exit();
    }    
    // Every fields OK
    else{
        // ? because sql injection
        $sql = "SELECT * FROM review NATURAL JOIN user NATURAL JOIN park WHERE username=? AND name=?"; //USERID AND PARKID CHECK!!!!!!!!
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../individual_sample.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ii", $username, $parkName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Check if user already reviewed this park or not
            if($resultCheck > 0){
                header("Location: ../individual_sample.php?error=parkreviewed");
                exit();
            }
            else{
                // Save review into DB
                $sql = "INSERT INTO review (content, rating, user_id, park_id) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../individual_sample.php?error=sqlerror");
                    exit();
                }
                else{
                    // Execute sql statement
                    mysqli_stmt_bind_param($stmt, "siii", $reviewContent, $reviewRating, $username, $parkName);// GET USERNAME AND PARKNAME
                    mysqli_stmt_execute($stmt);
                    // Return success
                    header("Location: ../individual_sample.php?reviewsubmission=success");
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
    header("Location: ../individual_sample.php");
    exit();
}