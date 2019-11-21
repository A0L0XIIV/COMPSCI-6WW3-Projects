<?php
if(isset($_POST['login-form'])){
    // Database conenction
    require 'dbh.inc.php';

    $emailUsername = $_POST['email-username'];
    $password = $_POST['user-password'];

    // Empty field check
    if(empty(emailUsername) || empty(password)){
        header("Location: ../login.php?error=emptyfields&emailUsername=".$emailUsername);
        exit();
    }    
    // Not empty
    else{
        // ? because sql injection
        $sql = "SELECT * FROM user WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $emailUsername, $emailUsername);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // Password check
            if($row = mysqli_fetch_assoc($result)){
                $passwordCheck = password_verify($password, $row['password']);
                if($passwordCheck == false){
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
                else if($passwordCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../login.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../login.php?error=nouser");
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