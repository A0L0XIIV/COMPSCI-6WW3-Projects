<?php
if(isset($_POST['review-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    session_start();

    $reviewRating = $_POST['review-rating'];
    $reviewContent = $_POST['review-content'];
    $parkId = $_POST['park-id'];
    $parkName = $_POST['park-name'];
    $username = $_SESSION['username'];
    $userId = $_SESSION['userId'];

    // Empty fields check
    if(empty($reviewRating) || empty($parkId)){
        echo '<h2 class="error">Some of the required fields were empty.</h2>';
        echo '<h2 class="error">Please fill all required fields and try again.</h2>';
    }       
    // Empty fields for session variables
    else if(empty($username) || empty($userId)){
        echo '<h2 class="error">Please login for this operation.</h2>';
    }     
    // Every fields OK
    else{
        // ? because sql injection
        $sql = "SELECT review_id FROM review WHERE user_id=? AND park_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo '<h2 class="error">Oops. Something went wrong!</h2>';
            echo '<h2 class="error">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</h2>';
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
                    echo '<h2 class="error">You\'ve already reviewed this park.</h2>';
                    echo '<h2 class="error">You cannot review the same park more than once.</h2>';
                }
                // No review found with park id
                else{
                    // Save review into DB
                    $sql = "INSERT INTO review (content, rating, user_id, park_id) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo '<h2 class="error">Oops. Something went wrong!</h2>';
                        echo '<h2 class="error">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</h2>';
                    }
                    else{
                        // Bind parameters into query
                        mysqli_stmt_bind_param($stmt, "siii", $reviewContent, $reviewRating, $userId, $parkId);
                        // Execute sql statement
                        mysqli_stmt_execute($stmt);
                        //mysqli_stmt_bind_result($stmt, $result);
                        mysqli_stmt_store_result($stmt);
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            echo '<h2 class="error">Oops. Something went wrong!</h2>';
                            echo '<h2 class="error">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</h2>';
                        }else{
                            // Return successfull review html
                            echo '<div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                    <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Place" content="Park">
                                    <meta itemprop="name" content="'.$parkName.'" />
                                    <div class="reviewUsernameAndRating">
                                        <h3 class="reviewUsername" id="newReviewAuthor" itemprop="author">'.$username.'</h3>
                                        <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                                            itemtype="http://schema.org/Rating">Rating:
                                            <span itemprop="ratingValue" id="newReviewRating">'.$reviewRating.'</span>
                                            <meta itemprop="bestRating" content="10">
                                            <meta itemprop="worstRating" content="1">
                                        </h3>
                                    </div>
                                    <div class="userReview" id="newReviewContent" itemprop="reviewBody">'.$reviewContent.'</div>
                                </div>
                            </li>
                    
                            <!--Line between each review-->
                            <li class ="usersNewReview">
                                <hr>';
                        }
                    }
                }
            }
            // mysqli_stmt_store_result error
            else{
                echo '<h2 class="error">Oops. Something went wrong!</h2>';
                echo '<h2 class="error">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</h2>';
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
// If the request coming from outside of the regitration page's form
else{
    echo '<h2 class="error">Oops. Something went wrong!</h2>';
    echo '<h2 class="error">Unauthorized access!</h2>';
}