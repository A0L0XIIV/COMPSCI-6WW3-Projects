<?php
if(isset($_POST['register-form'])){
    // Database conenction
    require 'dbh.inc.php';

    $username = $_POST['user-name'];
    $email = $_POST['user-email'];
    $password = $_POST['user-password'];
    $city = $_POST['user-city'];
    $phone = $_POST['user-phone'];
    $days = $_POST['days'];
    $period = $_POST['period'];
    $termsAndPrivacy = $_POST['terms-and-privacy'];

    // Empty field check
    if(empty(username) || empty(email)|| empty(password)){
        header("Location: ../registration.php?error=emptyfields&username=".$username."&email=".$email);
        exit();
    }    
    // Username and email regex check
    else if(!preg_match("/^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registration.php?error=invalidusernameemail");
        exit();
    }
    // Email check
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registration.php?error=invalidemail&username=".$username);
        exit();
    }
    // Username regex check
    else if(!preg_match("/^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$/", $username)){
        header("Location: ../registration.php?error=invalidusername&email=".$email);
        exit();
    }
    // Every fields OK
    else{
        // ? because sql injection
        $sql = "SELECT username FROM user WHERE username=? AND email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../registration.php?error=sqlerror1");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Check if username is taken or not
            if($resultCheck > 0){
                header("Location: ../registration.php?error=usertaken&email=".$email);
                exit();
            }
            else{
                // Save user into DB
                $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../registration.php?error=sqlerror2");
                    exit();
                }
                else{
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Execute sql statement
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    // Return success
                    header("Location: ../registration.php?registration=success");
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
    header("Location: ../registration.php");
    exit();
}