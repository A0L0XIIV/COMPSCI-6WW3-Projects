<?php
if(isset($_POST['register-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    // Get field values from post request
    $username = $_POST['user-name'];
    $email = $_POST['user-email'];
    $password = $_POST['user-password'];
    $city = $_POST['user-city'];
    $phone = $_POST['user-phone'];
    $days = $_POST['days'];
    $period = $_POST['period'];
    $termsAndPrivacy = $_POST['terms-and-privacy'];

    // Empty field check
    if(empty($username) || empty($email)|| empty($password)){
        header("Location: ../registration.php?error=emptyfields&username=".$username."&email=".$email."&city=".$city."&phone=".$phone);
        exit();
    }    
    // Username and email regex check
    else if(!preg_match("/^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registration.php?error=invalidusernameemail&username=&email=&city=".$city."&phone=".$phone);
        exit();
    }
    // Username regex check
    else if(!preg_match("/^([-_!&*()']*[a-zA-Z0-9]+[-_!&*()']*)+$/", $username)){
        header("Location: ../registration.php?error=invalidusername&username=&email=".$email."&city=".$city."&phone=".$phone);
        exit();
    }
    // Email check
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../registration.php?error=invalidemail&username=".$username."&email=&city=".$city."&phone=".$phone);
        exit();
    }
    // Password regex check
    else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_=+!@#$%^&*()]).{8,15}$/", $password)){
        header("Location: ../registration.php?error=invalidpassword&username=".$username."&email=".$email."&city=".$city."&phone=".$phone);
        exit();
    }
    // City regex check
    else if(!empty($city) && !preg_match("/^([a-zA-Z0-9]+[-&']*)+$/", $city)){
        header("Location: ../registration.php?error=invalidcity&username=".$username."&email=".$email."&city=&phone=".$phone);
        exit();
    }
    // Phone regex check
    else if(!empty($phone) && !preg_match("/^[+]?[0-9\s]{0,4}[(]?[0-9]{1,4}[)]?[-\s\.0-9]*$/", $phone)){
        header("Location: ../registration.php?error=invalidphone&username=".$username."&email=".$email."&city=".$city."&phone=");
        exit();
    }
    // Every fields OK
    else{
        // Check if user is already in DB or not
        $sql = "SELECT * FROM user WHERE username=? OR email=?";// ? because sql injection
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../registration.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Check if username is taken or not
            if($resultCheck > 0){
                header("Location: ../registration.php?error=usertaken&username=".$username."&email=".$email."&city=".$city."&phone=".$phone);
                exit();
            }
            else{
                // Save user into DB
                $sql = "INSERT INTO user (username, email, password, user_city, phone, visit_frequency) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../registration.php?error=sqlerror");
                    exit();
                }
                else{
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // Calculate visit frequency
                    if(!empty(days) && !empty(period)){
                        $visitFreq = NULL;
                        // Convert all of them into 1 year period
                        // DAYS 1=1-2, 3=2-3, 5=4-5, 7=7+
                        // PERIOD 52=week, 12=month, 4=session, 1=year
                        $visitFreq = $period * $days;
                    }
                    // Execute sql statement
                    mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $hashedPassword, $city, $phone, $visitFreq);
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