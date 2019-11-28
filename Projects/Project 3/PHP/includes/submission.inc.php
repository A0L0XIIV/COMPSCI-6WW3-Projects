<?php
if(isset($_POST['park-submit'])){
    // Database conenction
    require '../../../../mysqli_connect.php';
    // Get field values from post request
    $parkName = $_POST['park-name'];
    $parkDescription = $_POST['park-description'];
    $parkLatitude = $_POST['park-latitude'];
    $parkLongitude = $_POST['park-longitude'];
    $parkCountry = $_POST['park-country'];
    $parkRegion = $_POST['park-region'];
    $parkCity = $_POST['park-city'];
    $parkAddress = $_POST['park-address'];
    $parkPostal = $_POST['park-postal-code'];
    $parkImagesPath = '../../Park_Data/Images/'.$parkName.'/';
    $parkVideosPath = '../../Park_Data/Videos/'.$parkName.'/';
    // Create Images and Video directories for this park
    mkdir($parkImagesPath);
    mkdir($parkVideosPath);

    // Empty field check
    if(empty($parkName) || empty($parkLatitude)|| empty($parkLongitude)){
        header("Location: ../submission.php?error=emptyfields&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }    
    // Park name regex check
    else if(!preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkName)){
        header("Location: ../submission.php?error=invalidparkname&parkName=&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Latitude regex check
    else if(!preg_match("/^([-]?[0-9]{1,2}\.[0-9]{3,7})$/", $parkLatitude)){
        header("Location: ../submission.php?error=invalidlatitude&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Longitude regex check
    else if(!preg_match("/^([-]?[0-9]{1,2}\.[0-9]{3,7})$/", $parkLongitude)){
        header("Location: ../submission.php?error=invalidlongitude&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Country regex check
    else if(!empty($parkCountry) && !preg_match("/[a-zA-Z ]{2,}/", $parkCountry)){
        header("Location: ../submission.php?error=invalidcountry&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Region regex check
    else if(!empty($parkRegion) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkRegion)){
        header("Location: ../submission.php?error=invalidregion&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=
        &parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // City regex check
    else if(!empty($parkCity) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkCity)){
        header("Location: ../submission.php?error=invalidcity&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=&parkAddress=".$parkAddress."&parkPostal=".$parkPostal);
        exit();
    }
    // Address regex check
    else if(!empty($parkAddress) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkAddress)){
        header("Location: ../submission.php?error=invalidaddress&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=&parkPostal=".$parkPostal);
        exit();
    }
    // Postal code regex check
    else if(!empty($parkPostal) && !preg_match("/^([a-zA-Z0-9 ]+[-&']*)+$/", $parkPostal)){
        header("Location: ../submission.php?error=invalidpostal&parkName=".$parkName."&parkDescription=".$parkDescription.
        "&parkLatitude=".$parkLatitude."&parkLongitude=".$parkLongitude."&parkCountry=".$parkCountry."&parkRegion=".$parkRegion.
        "&parkCity=".$parkCity."&parkAddress=".$parkAddress."&parkPostal=");
        exit();
    }
    // Every fields OK
    else{
        // Check if park name is already in DB or not
        $sql = "SELECT * FROM park WHERE park_name=?";// ? because sql injection
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../submission.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $parkName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Check if username is taken or not
            if($resultCheck > 0){
                header("Location: ../submission.php?error=parkexist");
                exit();
            }
            else{
                // Save user into DB
                $sql = "INSERT INTO park (park_name, description, latitude, longitude, country, 
                        region, city, address, postal_code, images_path, video_path) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../submission.php?error=sqlerror");
                    exit();
                }
                else{
                    // Bind inputs to query parameters
                    mysqli_stmt_bind_param($stmt, "ssddsssssss", $parkName, $parkDescription, $parkLatitude, $parkLongitude, $parkCountry, 
                                            $parkRegion, $parkCity, $parkAddress, $parkPostal, $parkImagesPath, $parkVideosPath);
                    // Execute sql statement
                    mysqli_stmt_execute($stmt);

                    // Upload images and videos

                    // Count total images
                    $countImages = count($_FILES['park-image']['name']);
                    // Image error booleans
                    $imageExist = false;
                    $imageTooLarge = false;
                    $imageFormatError = false;
                    $imageUploadError = false;
                    
                    // Looping all images
                    for($i = 0; $i < $countImages; $i++){
                        // Get image file types
                        $imageFormat = strtolower(pathinfo($parkImagesPath.basename($_FILES["park-image"]["name"][$i]),PATHINFO_EXTENSION));
                        // Create a name for Image --> Test Park_image_1
                        $imageFile = $parkImagesPath . $parkName . '_image_' . $i . '.' . $imageFormat;
                        
                        // Check if image already exists
                        if (file_exists($imageFile)) {
                            $imageExist = true;
                        }
                        // Check image size --> Max 2MB
                        else if ($_FILES["park-image"]["size"][$i] > 2000000) {
                            $imageTooLarge = true;
                        }
                        // Check image format --> jpg, png, jpeg
                        else if($imageFormat != "jpg" && $imageFormat != "png" && $imageFormat != "jpeg" ) {
                            $imageFormatError = true;
                        }
                        // No error ==> Upload image
                        else {
                            // Try to upload image
                            if(!move_uploaded_file($_FILES['park-image']['tmp_name'][$i], $imageFile)){
                                // header("Location: ../submission.php?error=uploaderrorimg".$i."&errno=".$_FILES['park-image']['error']);
                                // exit();
                                $imageUploadError = true;
                            }
                        }
                    }

                    // Get video's file format
                    $videoFormat = strtolower(pathinfo($parkVideosPath.basename($_FILES["park-video"]["name"]),PATHINFO_EXTENSION));
                    // Create a name for Video --> Test Park_video
                    $videoFile = $parkVideosPath . $parkName . '_video.'.$videoFormat;
                    // Check if video already exists
                    if (file_exists($videoFile)) {
                        header("Location: ../submission.php?error=videoexist");
                        exit();
                    }
                    // Check video size --> Max 5MB
                    else if ($_FILES["park-video"]["size"] > 5000000) {
                        header("Location: ../submission.php?error=toolargevideo");
                        exit();
                    }
                    // Check video format
                    else if($videoFormat != "mp4" && $videoFormat != "webm" && $videoFormat != "ogg" ) {
                        header("Location: ../submission.php?error=videotype");
                        exit();
                    }
                    // No error ==> Upload video
                    else {
                        // Try to upload video
                        if (!move_uploaded_file($_FILES["park-video"]["tmp_name"], $videoFile)) {
                            header("Location: ../submission.php?error=videouploaderror&no=". $_FILES['park-video']['error']);
                            exit();
                        }
                    }

                    // Some of the images already exist
                    if($imageExist){
                        header("Location: ../submission.php?error=imageexist");
                        exit();
                    }
                    // Some of the images are too large
                    else if($imageTooLarge){
                        header("Location: ../submission.php?error=toolargeimage");
                        exit();
                    }
                    // Some of the images' format is not supported
                    else if($imageFormatError){
                        header("Location: ../submission.php?error=imagetype");
                        exit();
                    }
                    // Some of the images' upload failed
                    else if($imageUploadError){
                        header("Location: ../submission.php?error=uploaderrorimg");
                        exit();
                    }
                    // Return success --> Park added into DB and images/video uploaded correctly.
                    else{
                        header("Location: ../submission.php?success=submission");
                        exit();
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
// If the request coming from outside of the regitration page's form
else{
    header("Location: ../submission.php?error=unauthorized");
    exit();
}