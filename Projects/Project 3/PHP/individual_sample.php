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

<!-- Get Park data from database -->
<?php
    if(isset($_GET['get-park'])){
        // Database conenction
        require '../../../mysqli_connect.php';

        $parkId = $_POST['park-id'];
        // Empty field check
        if(empty($parkId)){
            header("Location: ../individual_sample.php?error=emptyparkid");
            exit();
        }    
        // Every fields OK
        else{
            // ? because sql injection
            $sql = "SELECT * FROM park WHERE id=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../individual_sample.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "i", $parkId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $parkName = $row['name'];
                    $parkDescription = $row['description'];
                    $parkLatitude = $row['latitude'];
                    $parkLongitude = $row['longitude'];
                    $parkCountry = $row['country'];
                    $parkRegion = $row['region'];
                    $parkCity = $row['city'];
                    $parkAddress = $row['address'];
                    $parkPostal = $row['postal_code'];
                    $parkImages = $row['images'];
                    $parkVideos = $row['videos'];
                }
            }
        }
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
            <a href="./individual_sample.php?id=".$parkId class="parkName">
                <?php if(!empty($parkName)) 
                        echo $parkName; 
                    else 
                        echo 'Park';
                ?>
            </a>
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
            <div id="parkImageCarousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active" data-toggle="modal" data-target="#parkImageModal">
                        <a href="#parkImageModalCarousel" data-slide-to="0">
                            <img class="d-block w-100" src="../Images/ParkImages/HGP_1.jpg" alt="First slide">
                        </a>
                    </div>
                    <div class="carousel-item" data-toggle="modal" data-target="#parkImageModal">
                        <a href="#parkImageModalCarousel" data-slide-to="1">
                            <img class="d-block w-100" src="../Images/ParkImages/HGP_2.jpg" alt="Second slide">
                        </a>
                    </div>
                    <div class="carousel-item" data-toggle="modal" data-target="#parkImageModal">
                        <a href="#parkImageModalCarousel" data-slide-to="2">
                            <img class="d-block w-100" src="../Images/ParkImages/HGP_3.jpg" alt="Third slide">
                        </a>
                    </div>
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
                            <div class="parkName">Park Images</div>
                            <button type="button" class="close" data-dismiss="modal" title="Close">
                                <i class="fa fa-window-close" aria-hidden="true"></i>
                            </button>
                        </div>
                        <!-- Without modal body, modal doesn't have any white edges. -->
                        <div class="modal-body">
                            <!-- Image Carousel -->
                            <div id="parkImageModalCarousel" class="carousel slide" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="../Images/ParkImages/HGP_1.jpg" alt="First slide">
                                        <div class="carousel-caption"></div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="../Images/ParkImages/HGP_2.jpg" alt="Second slide">
                                        <div class="carousel-caption"></div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="../Images/ParkImages/HGP_3.jpg" alt="Third slide">
                                        <div class="carousel-caption"></div>
                                    </div>
                                </div>
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
            </div>

        </div>
    </div>

    <div>
        <!-- Video of the park -->
        <video width="480" height="360" controls>
            <source src="../Videos/aFewMomentsLater.mp4" type="video/mp4">
            Cannot play the park's video
        </video>
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
    </div>
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
                placeholder="Review content (max 550 words)"
            ></textarea>
            <br />
            <br />
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
        <!-- Review 1 -->
        <li>
            <div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Place" content="Park">
                <meta itemprop="name" content="Highland Garden's Park" />
                <div class="reviewUsernameAndRating">
                    <h3 class="reviewUsername" itemprop="author">User 1</h3>
                    <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                        itemtype="http://schema.org/Rating">Rating:
                        <span itemprop="ratingValue">8</span>
                        <meta itemprop="bestRating" content="10">
                        <meta itemprop="worstRating" content="1">
                    </h3>
                </div>
                <div class="userReview" itemprop="reviewBody">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec orci augue. In at quam
                    lacus. Proin in erat a neque tempus pharetra. In ante nibh, luctus quis risus vitae,
                    molestie
                    porta justo. Fusce leo neque, tincidunt nec justo in, egestas mollis arcu. Aliquam erat
                    volutpat. In pharetra commodo augue non commodo. Nullam ultrices, tortor ac imperdiet
                    tempor,
                    quam mi placerat enim, viverra porta erat urna nec arcu. Maecenas auctor nulla nec maximus
                    convallis. Nunc lacinia risus in diam interdum feugiat. Vivamus vehicula nisi ut ornare
                    semper.
                </div>
            </div>
        </li>

        <!--Line between each review-->
        <li>
            <hr>
        </li>

        <!-- Review 2 -->
        <li>
            <div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Product" content="Park">
                <meta itemprop="name" content="Highland Garden's Park" />
                <div class="reviewUsernameAndRating">
                    <h3 class="reviewUsername" itemprop="author">User 2</h3>
                    <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                        itemtype="http://schema.org/Rating">Rating:
                        <span itemprop="ratingValue">10</span>
                        <meta itemprop="bestRating" content="10">
                        <meta itemprop="worstRating" content="1">
                    </h3>
                </div>
                <div class="userReview">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec orci augue. In at quam
                    lacus. Proin in erat a neque tempus pharetra. In ante nibh, luctus quis risus vitae,
                    molestie porta justo. Fusce leo neque, tincidunt nec justo in, egestas mollis arcu. Aliquam
                    erat volutpat. In pharetra commodo augue non commodo. Nullam ultrices, tortor ac imperdiet
                    tempor, quam mi placerat enim, viverra porta erat urna nec arcu. Maecenas auctor nulla nec
                    maximus convallis. Nunc lacinia risus in diam interdum feugiat. Vivamus vehicula nisi ut
                    ornare semper.
                    <br>
                    Sed eget elit congue, tincidunt sem eget, viverra ipsum. In lacus turpis, consectetur non
                    odio ut, hendrerit mattis dolor. Nam viverra orci non enim rhoncus, non commodo lacus
                    feugiat. Curabitur eu sollicitudin urna. Duis semper turpis at hendrerit pellentesque. Class
                    aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla
                    non porttitor nisi. Duis consectetur ante nunc, quis euismod erat facilisis at. Nam diam
                    nisl, porta sit amet magna at, fermentum consequat nunc. Pellentesque ultricies laoreet
                    massa ultrices feugiat. Donec pharetra purus vel purus vulputate maximus. Aliquam id mi a
                    ligula placerat ultrices.
                </div>
            </div>
        </li>

        <!--Line between each review-->
        <li>
            <hr>
        </li>

        <!-- Review 3 -->
        <li>
            <div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Product" content="Park">
                <meta itemprop="name" content="Highland Garden's Park" />
                <div class="reviewUsernameAndRating">
                    <h3 class="reviewUsername" itemprop="author">User 3</h3>
                    <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                        itemtype="http://schema.org/Rating">Rating:
                        <span itemprop="ratingValue">9</span>
                        <meta itemprop="bestRating" content="10">
                        <meta itemprop="worstRating" content="1">
                    </h3>
                </div>
                <div class="userReview">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec orci augue. In at quam
                    lacus. Proin in erat a neque tempus pharetra. In ante nibh, luctus quis risus vitae,
                    molestie
                    porta justo. Fusce leo neque, tincidunt nec justo in, egestas mollis arcu. Aliquam erat
                    volutpat.
                </div>
            </div>
        </li>

        <!--Line between each review-->
        <li>
            <hr>
        </li>

        <!-- Review 4 -->
        <li>
            <div class="reviewDiv" itemprop="review" itemscope itemtype="http://schema.org/Review">
                <meta itemprop="itemreviewed" itemscope itemtype="http://schema.org/Product" content="Park">
                <meta itemprop="name" content="Highland Garden's Park" />
                <div class="reviewUsernameAndRating">
                    <h3 class="reviewUsername" itemprop="author">User 4</h3>
                    <h3 class="reviewUserRating" itemprop="reviewRating" itemscope
                        itemtype="http://schema.org/Rating">Rating:
                        <span itemprop="ratingValue">6</span>
                        <meta itemprop="bestRating" content="10">
                        <meta itemprop="worstRating" content="1">
                    </h3>
                </div>
                <div class="userReview">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec orci augue. In at quam
                    lacus. Proin in erat a neque tempus pharetra. In ante nibh, luctus quis risus vitae,
                    molestie
                    porta justo. Fusce leo neque, tincidunt nec justo in, egestas mollis arcu. Aliquam erat
                    volutpat. In pharetra commodo augue non commodo. Nullam ultrices, tortor ac imperdiet
                    tempor,
                    quam mi placerat enim, viverra porta erat urna nec arcu. Maecenas auctor nulla nec maximus
                    convallis. Nunc lacinia risus in diam interdum feugiat. Vivamus vehicula nisi ut ornare
                    semper.
                </div>
            </div>
        </li>
    </ul>
</div>
</main>

<?php
    require "footer.php";
?>