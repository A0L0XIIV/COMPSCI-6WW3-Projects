<?php
    require "head.php";
?>

<!-- LeafletJS CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
<!-- LeafletJS JavaScript -->
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""></script>

<!-- Twitter Cards Metadata-->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@parkrater" />

<!-- Open Graph Metadata -->
<meta property="og:title" content="Highland Garden's Park" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://www.parkrater.com/park/abc123/" />
<!--Open Graph image properties -->
<meta property="og:image" content="http://www.parkrater.com/park/abc123/images/abc123img123.jpg" />
<meta property="og:image:secure_url" content="https://www.parkrater.com/park/abc123/images/abc123img123.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:image:alt" content="Picture of the park" />
<!-- Open Grah other properties -->
<meta property="og:description" content="Highland Garden's Park, Hamilton, ON, Canada" />
<meta property="og:determiner" content="" />
<meta property="og:site_name" content="ParkRater" />

<?php 
    require "header.php";
?>

<!-- Get data from database -->
<?php
    if(isset($_POST['get-park'])){
        // Database conenction
        require '../../mysqli_connect.php';

        $parkId = $_POST['id'];
        // Empty field check
        if(empty($parkId)){
            echo '<p class="notFound">Oops. Something went wrong!</p>'; 
            echo '<p class="notFound">Park ID is empty.</p>'; 
            require "footer.php";
            exit();
        }    
        // Every fields OK
        else{
            // Get Park data from database
            if($parkId == 'random'){
                $sql = "SELECT park_name, description, latitude, longitude, country, region, city, address, postal_code, images_path, video_path 
                        FROM park ORDER BY RAND() LIMIT 1";
            }
            else{
                $sql = "SELECT park_name, description, latitude, longitude, country, region, city, address, postal_code, images_path, video_path 
                        FROM park WHERE park_id=?";// ? because sql injection
            }
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo '<p class="notFound">Oops. Something went wrong!</p>';
                echo '<p class="notFound">We have some issues about SQL DB. Error no:'.mysqli_errno($conn).'</p>'; 
                require "footer.php";
                exit();
            }
            else{
                // Bind park id into sql query
                if($parkId != 'random')
                    mysqli_stmt_bind_param($stmt, "i", $parkId);
                // Execute the sql query
                mysqli_stmt_execute($stmt);
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $parkName, $parkDescription, $parkLatitude, $parkLongitude, $parkCountry,
                                        $parkRegion, $parkCity, $parkAddress, $parkPostal, $parkImages, $parkVideo);
                // Store results
                if(mysqli_stmt_store_result($stmt)){
                    // Check if DB returned any park
                    if(mysqli_stmt_num_rows($stmt) > 0){
                        // Fetch values
                        while (mysqli_stmt_fetch($stmt)) {
                            // Get the park's reviews from DB
                            $sql_review = "SELECT review_id, content, rating, user.username FROM review 
                                    INNER JOIN park ON review.park_id=park.park_id
                                    INNER JOIN user ON review.user_id=user.user_id
                                    WHERE park.park_id=?";// ? because sql injection
                            $stmt_review = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt_review, $sql_review)){
                                echo '<p class="notFound">Oops. Something went wrong!</p>';
                                echo '<p class="notFound">We have some issues about SQL DB. Error no: '.mysqli_errno($conn).'</p>'; 
                                require "footer.php";
                                exit();
                            }
                            else{
                                 // Bind park id into sql query
                                mysqli_stmt_bind_param($stmt_review, "i", $parkId);
                                // Execute the sql query
                                mysqli_stmt_execute($stmt_review);
                                // Bind result variables
                                mysqli_stmt_bind_result($stmt_review, $reviewId, $reviewContent, $reviewRating, $reviewUsername);
                                // Results fetched below... 
                            }
                        }
                    }
                    // No park found with park id
                    else{
                        echo '<p class="notFound">The park you are looking for is not here.</p>';
                        echo '<p class="notFound">It might be deleted or never added into system.</p>';  
                        require "footer.php";
                        exit();
                    }
                }
                // mysqli_stmt_store_result error for park
                else{
                    echo '<p class="notFound">Oops. Something went wrong!</p>';
                    echo '<p class="notFound">We have some issues about storing results. Error '.mysqli_errno($conn).'</p>';
                    require "footer.php";
                    exit();
                }
            }
        }
    }
    else{
        echo '<p class="notFound">Unauthorized access!</p><br/>';
        require "footer.php";
        exit();
    }
?>

<!-- Centered main-->
<main class="main">

    <!-- Breadcrum: Navigation -->
    <div class="breadcrumb" role="navigation">
        <ul>
            <li>
                <a href="./index.php">Home</a>
            </li>
            <li>></li>
            <li>
                <?php if(!empty($parkName)) 
                        echo $parkName; 
                    else 
                        echo 'Park';
                ?>
            </li>
        </ul>
    </div>

    <!-- Park with Place scheme -->
    <div itemscope itemtype="http://schema.org/Place" class="parkData">
        <!-- Name of the park -->
        <h1 itemprop="name" class="parkName">
            <?php if(!empty($parkName)) 
                    echo $parkName; 
                else 
                    echo 'Park';
            ?>
        </h1>

        <div class="parkMapAndImages">
            <!-- Map of the park -->
            <div class="parkMap">
                <div id="map"></div>
            </div>

            <!-- Images of the park -->
            <div class="parkImages" role="img" aria-label="Park's Image">
                <!-- Park Image Carousel (Bootstrap) -->
                <?php
                $lessImagePath = '../Park_Data/Images/'.$parkName.'/'.$parkName.'_image_';
                if(file_exists($lessImagePath.'0.jpg')){
                    echo '
                    <div id="parkImageCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">';
                                // Uploaded types are jpg, png and jpeg but here its static jpg!
                                $i = 0; 
                                while(file_exists($lessImagePath.$i.'.jpg')){
                                    $imagePath = $lessImagePath.$i.'.jpg';
                                    // Active carousel item
                                    if($i == 0){
                                        echo '<div class="carousel-item active" data-toggle="modal" data-target="#parkImageModal">';
                                    } 
                                    // Other items
                                    else {
                                        echo '<div class="carousel-item" data-toggle="modal" data-target="#parkImageModal">';
                                    }
                                    echo '<a href="#parkImageModalCarousel" data-slide-to="'.$i.'">
                                                <img class="d-block w-100" src="'.$imagePath.'" alt="Image '.$i.'">
                                            </a>
                                        </div>';
                                    $i++;
                                }
                    echo '
                        </div>
                        <!-- Slider for next and previos images -->
                        <a class="carousel-control-prev" href="#parkImageCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#parkImageCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!-- Park Image Carousel Modal (PopUp) (Bootstrap) -->
                    <div class="modal fade" id="parkImageModal">
                        <!-- Modal size Extra Large for bigger images -->
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="parkName">'.$parkName.' Images</div>
                                    <button type="button" class="close" data-dismiss="modal" title="Close">
                                        <i class="fa fa-window-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <!-- Without modal body, modal doesn\'t have any white edges. -->
                                <div class="modal-body">
                                    <!-- Image Carousel -->
                                    <div id="parkImageModalCarousel" class="carousel slide" data-interval="false">
                                        <div class="carousel-inner">';
                                            // Uploaded types are jpg, png and jpeg but here its static jpg!
                                            $j = 0; 
                                            while(file_exists($lessImagePath.$j.'.jpg')){
                                                $imagePath = $lessImagePath.$j.'.jpg';
                                                // Active carousel item start div
                                                if($j == 0){
                                                    echo '<div class="carousel-item active" data-toggle="modal" data-target="#parkImageModal">';
                                                } 
                                                // Other carousel items start div
                                                else {
                                                    echo '<div class="carousel-item" data-toggle="modal" data-target="#parkImageModal">';
                                                }
                                                echo '<img class="d-block w-100" src="'.$imagePath.'" alt="Image '.$j.'">
                                                        <div class="carousel-caption"></div>
                                                    </div>';
                                                $j++;
                                            }
                    echo '              </div>
                                    <!-- Slider for next and previos images -->
                                    <a class="carousel-control-prev" href="#parkImageModalCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#parkImageModalCarousel" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                else{
                    echo'<div>
                            <p class="error">This park has no image yet.</p>
                        </div>';
                }
                ?>

            </div>
        </div>

        <div>
            <!-- Video of the park -->
            <?php
                // Uploaded types are mp4, avi and gif but here its static mp4! 
                $videoPath = '../Park_Data/Videos/'.$parkName.'/'.$parkName.'_video.mp4';
                if(file_exists($videoPath)){
                    echo '<video width="480" height="360" controls>
                            <source src="'.$videoPath.'" type="video/mp4">Cannot play the park\'s video</video>';
                }
            ?>
        </div>

        <hr>

        <div class="parkPropertiesAndDescription">
            <h2>Park Properties</h2>
            <!-- Park properties -->
            <div class="parkProperties">
                <!-- Coordinates of the park with schema geo coordinates microdata -->
                <ul itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                    <li>
                        <b>Latitude:</b>
                        <span itemprop="latitude" id="latitude">
                            <?php if(!empty($parkLatitude)) 
                                    echo $parkLatitude; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                    <li>
                        <b>Longitude:</b>
                        <span itemprop="longitude" id="longitude">
                            <?php if(!empty($parkLongitude)) 
                                    echo $parkLongitude; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                </ul>
                <!-- Address of the park with schema postal address microdata -->
                <ul itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <li>
                        <b>Country:</b>
                        <span itemprop="addressCountry" id="addressCountry">
                            <?php if(!empty($parkCountry)) 
                                    echo $parkCountry; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                    <li>
                        <b>State/Region:</b>
                        <span itemprop="addressRegion" id="addressRegion">
                            <?php if(!empty($parkRegion)) 
                                    echo $parkRegion; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                    <li>
                        <b>City:</b>
                        <span itemprop="addressLocality" id="addressLocality">
                            <?php if(!empty($parkCity)) 
                                    echo $parkCity; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                    <li>
                        <b>Address:</b>
                        <span itemprop="streetAddress" id="streetAddress">
                            <?php if(!empty($parkAddress)) 
                                    echo $parkAddress; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                    <li>
                        <b>PostalCode:</b>
                        <span itemprop="postalCode" id="postalCode">
                            <?php if(!empty($parkPostal)) 
                                    echo $parkPostal; 
                                else 
                                    echo 'N/A';
                            ?>
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Description of the park -->
            <div class="parkDescription">
                <?php if(!empty($parkDescription)) 
                        echo $parkDescription; 
                    else 
                        echo 'N/A';
                ?>
            </div>
        </div>

        <hr>
        <div>
            <h2>Reviews</h2>
            <button class="searchButton" id='showButton' aria-pressed="false" onclick=showNewReview()>Write a Review</button>
            <button class="searchButton cancelButton" id ='hideButton' aria-pressed="false" onclick=hideNewReview()>Cancel</button>
            <br/>
            <span class="error" id='showLoginError'>Please sign in to write a review!
                <br/>
                Redirecting to login page...
            </span>
        </div>
        <input type="hidden" id="sessionUsername" style="display:none" 
            value="<?php if(isset($_SESSION['username'])){
                echo $_SESSION['username'];} 
                else{
                    echo NULL;
                    }?>"/>
        <!--Input/textarea for park description, type=textarea-->
        <div class="newReview">
            <hr>
            <form
                name="review-form"
                id="review-form"
                action="includes/review.inc.php"
                method="post"
            >
                <p>Your review about this park:</p>
                <select name="review-rating">
                    <option value="" hidden selected>Rating</option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
                <br />
                <br />
                <textarea
                    rows="3"
                    cols="30"
                    maxlength="550"
                    name="review-content"
                    id="reviewContent"
                    value="<?php if(isset($_REQUEST['reviewContent'])) echo $_REQUEST['reviewContent'];?>"
                    placeholder="Review content (max 550 words)"
                ></textarea>
                <br />
                <br />      
                <input value="<?php echo $parkId; ?>" name="park-id" hidden/>
                <input
                    type="submit"
                    value="Submit"
                    name="review-submit"
                    class="submitButton"
                    aria-pressed="false"
                />
            </form>
        </div>
        <hr>

        <!-- Reviews -->
        <ul>
            <!-- Review PHP -->
            <?php                         
                // Store results
                if(mysqli_stmt_store_result($stmt_review)){
                    // Check if DB returned any park
                    if(mysqli_stmt_num_rows($stmt_review) > 0){
                        // Fetch values
                        while (mysqli_stmt_fetch($stmt_review)) {
                            echo '<li>
                                    <div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                        <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Place" content="Park">
                                        <meta itemprop="name" content='.$parkName.' />
                                        <div class="reviewUsernameAndRating">
                                            <h3 class="reviewUsername" itemprop="author">'.$reviewUsername.'</h3>
                                            <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                                                itemtype="http://schema.org/Rating">Rating:
                                                <span itemprop="ratingValue">'.$reviewRating.'</span>
                                                <meta itemprop="bestRating" content="10">
                                                <meta itemprop="worstRating" content="1">
                                            </h3>
                                        </div>
                                        <div class="userReview" itemprop="reviewBody">'.$reviewContent.'</div>
                                    </div>
                                </li>
                        
                                <!--Line between each review-->
                                <li>
                                    <hr>
                                </li>';
                        }
                    }
                    // No review found with park id
                    else{
                        echo '<li>
                        <p class="success">This park does not have any reviews. You can add the first review!</p>
                        </li>';
                    }
                }
                // mysqli_stmt_store_result error for review
                else{
                    echo '<li>
                        <p class="error">Oops. Something went wrong!</p>
                        <p class="error">We have some issues about storing results. Error '.mysqli_errno($conn).'</p>
                        <p class="success">This park does not have any reviews. You can add the first review!</p>
                    </li>';
                }
            
            ?>
        </ul>
    </div>
</main>

<?php
    require "footer.php";
?>