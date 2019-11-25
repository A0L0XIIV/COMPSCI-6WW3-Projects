<?php
if(isset($_POST['login-submit'])){
    // Database conenction
    require '../../../mysqli_connect.php';

    // Login form's variables
    $emailUsername = $_POST['email-username'];
    $password = $_POST['user-password'];

    // Empty field check
    if(empty($emailUsername) || empty($password)){
        header("Location: ../login.php?error=emptyfields&emailUsername=".$emailUsername);
        exit();
    }    
    // Not empty
    else{
        // ? because sql injection
        $sql = "SELECT user_id, username, password FROM user WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else{
            // Bind variables to query
            mysqli_stmt_bind_param($stmt, "ss", $emailUsername, $emailUsername);
            // Execute SQL query
            mysqli_stmt_execute($stmt);
             // Bind result variables
             mysqli_stmt_bind_result($stmt, $userId, $username, $hashedPassword);
             // Store results
             if(mysqli_stmt_store_result($stmt)){
                 // Check DB if user exist 
                 if(mysqli_stmt_num_rows($stmt) > 0){
                    // User exist
                    while (mysqli_stmt_fetch($stmt)) {
                        // Password control
                        $passwordCheck = password_verify($password, $hashedPassword);
                        // Wrong password --> Auth error
                        if($passwordCheck == false){
                            header("Location: ../login.php?error=autherror");
                            exit();
                        }
                        // Correct password --> redirect to index page
                        else if($passwordCheck == true){
                            session_start();
                            $_SESSION['userId'] = $userId;
                            $_SESSION['username'] = $username;
                            header("Location: ../index.php?login=success");
                            exit();
                        }
                        // Any other case --> Auth error
                        else{
                            header("Location: ../login.php?error=autherror");
                            exit();
                        }
                    }
                 }
                 // User doesn't exist
                 else{
                     header("Location: ../login.php?error=autherror");
                     exit();
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
// If the request coming from outside of the login page's form
else{
    header("Location: ../index.php");
    exit();
}