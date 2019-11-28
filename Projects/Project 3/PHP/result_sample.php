<?php
    require "head.php";
?>

<!-- LeafletJS CSS -->
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""
/>
<!-- LeafletJS JavaScript -->
<script
    src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""
></script>

<?php 
    require "header.php";
?>


<!-- Get data from database -->
<?php
    if(isset($_GET['get-results'])){
        // Database conenction
        require '../../../mysqli_connect.php';

        $searchResult = $_GET['result'];
        // Empty field check
        if(empty($searchResult)){
            echo '<p class="notFound">Oops. Something went wrong!</p>'; 
            echo '<p class="notFound">Search result is empty.</p>'; 
            require "footer.php";
            exit();
        }    
        // Every fields OK
        else{
            // Convert comma seperated string to array
            $parkIdArray = explode(',', $searchResult);
            // Get array size
            $parkIdArraySize = count($parkIdArray);
            // Convert array to SQL IN array
            $in = join(',', array_fill(0, $parkIdArraySize, '?'));
            // SQL query with array of park_ids. $in fills the area with #parkIdArraySize ? --> (?, ?, ?...)
            $sql = "SELECT park_id, park_name, description, latitude, longitude
                    FROM park WHERE park_id IN (".$in.") ORDER BY park_name";// ? because sql injection
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo '<p class="notFound">Oops. Something went wrong!</p>';
                echo '<p class="notFound">We have some issues about SQL. Error '.mysqli_errno($conn).'</p>'; 
                require "footer.php";
                exit();
            }
            else{
                // Repeats i (id==>int) #parkIdArraySize times
                mysqli_stmt_bind_param($stmt, str_repeat('i', $parkIdArraySize), ...$parkIdArray);
                mysqli_stmt_execute($stmt);
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $parkId, $parkName, $parkDescription, $parkLatitude, $parkLongitude);
               // Result printing operations handled below
            }
        }
    }
    else{
        echo '<p class="notFound">Who are you exactly? Stop that!</p>'; 
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
            <a href="./search.php">Search</a>
        </li>
        <li>></li>
        <li>
            <span>Results</span>
        </li>
    </ul>
    </div>

    <!-- Tabs for map and tabular results -->
    <ul class="nav nav-tabs">
    <li>
        <a
        class="nav-link active"
        id="tabular-results"
        data-toggle="tab"
        href="#tabularResults"
        role="tab"
        aria-controls="tabular-results"
        aria-selected="true"
        >Tabular</a
        >
    </li>
    <li>
        <a
        class="nav-link"
        id="map-results"
        data-toggle="tab"
        href="#mapResults"
        role="tab"
        aria-controls="map-results"
        aria-selected="false"
        >Map</a
        >
    </li>
    </ul>

    <div class="tab-content">
        <!-- Tabular results -->
        <div
            class="tab-pane fade show active"
            id="tabularResults"
            role="tabpanel"
            aria-labelledby="tabular-results-tab"
        >
            <div class="row mx-auto" id="tabularResults">
                <!-- PHP Result -->
                <?php
                    // Store results
                    if(mysqli_stmt_store_result($stmt)){
                        // Check if DB returned any park
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            // i variable for map ids for map loading
                            $i = 0;
                            // Fetch values
                            while (mysqli_stmt_fetch($stmt)) {
                                echo '<div class="col-12">
                                        <hr />
                                        <!-- Name of the park -->
                                        <h2 id="parkName'.$i.'">'.$parkName.'</h2>
                                        <hr />
                                    </div>
                                    <!-- Map of the park -->
                                    <div class="col-md-3 col-sm-12 pb-2">
                                        <div id="map'.$i.'" class="map"></div>
                                    </div>
                                    <!-- Basic information of the park -->
                                    <div class="text-justify col-md-7 col-sm-10 col-xs-12 pb-2">
                                        <p>'.$parkDescription.'</p>
                                        <span id="latitude'.$i.'" hidden>'.$parkLatitude.'</span>
                                        <span id="longitude'.$i.'" hidden>'.$parkLongitude.'</span>
                                        <span id="parkId'.$i.'" hidden>'.$parkId.'</span>
                                    </div>
                                    <div class="col-sm-2 col-xs-12 align-middle">
                                        <!-- Link to park\'s individual page -->
                                        <a href="./individual_sample.php?get-park&id='.$parkId.'">Detailed info</a>
                                        
                                    </div>';
                                    $i++;
                            }
                        }
                        // No park found with user's criteria
                        else{
                            echo '<p class="notFound">We could not find a park with that search parameters.</p>'; 
                            require "footer.php";
                            exit();
                        }
                    }
                    // mysqli_stmt_store_result error
                    else{
                        echo '<p class="notFound">Oops. Something went wrong!</p>';
                        echo '<p class="notFound">We have some issues about storing results.</p>'; 
                        require "footer.php";
                        exit();
                    }
                ?>
            </div>
        </div>

        <!-- Map Results -->
        <div
            class="tab-pane fade"
            id="mapResults"
            role="tabpanel"
            aria-labelledby="map-results-tab"
        >
            <div id="mapResultsMap" class="map"></div>
            <br />
        </div>
    </div>
</main>

<?php
    require "footer.php";
?>