<?php 
    require "head.php";
?>
<?php 
    require "header.php";
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
        <a href="./submission.php">Add a Park</a>
        </li>
    </ul>
    </div>

    <form
        name="submission-form"
        id="submissionForm"
        action="includes/submission.inc.php"
        method="post"
        enctype="multipart/form-data"
      >

      <?php
        // Successfully added
        if(isset($_GET['success']) && $_GET['success'] == "submission"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="success">Images and video uploaded successfully.</p>';
        }
        // Unauthorized access
        else if(isset($_GET['error']) && $_GET['error'] == "unauthorized"){
            echo '<p class="error">Unauthorized submission.</p>';
            echo '<p class="error">Please only use the 
            <a href="./submission.php">New park</a> 
            page for park submission.</p>';
        }
        // Empty field error
        else if(isset($_GET['error']) && $_GET['error'] == "emptyfields"){
            echo '<p class="error">Please fill all required fields.</p>';
        }
        // Already exist error
        else if(isset($_GET['error']) && $_GET['error'] == "parkexist"){
            echo '<p class="error">This park is already in the ParkRater.</p>';
        }
        // Invalid park name error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidparkname"){
            echo '<p class="error">This park name is invalid.</p>';
            echo '<p class="error">Please use only letters, numbers and -&\' characters. Max letters is 50.</p>';
        }
        // Invalid latitude error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidlatitude"){
            echo '<p class="error">This park latitude is invalid.</p>';
            echo '<p class="error">Min: -90, Max:90, Decimal max:7, 00.0000000</p>';
        }
        // Invalid longitude error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidlongitude"){
            echo '<p class="error">This park longitude is invalid.</p>';
            echo '<p class="error">Min: -90, Max:90, Decimal max:7, 00.0000000</p>';
        }
        // Invalid country error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidcountry"){
            echo '<p class="error">This park country name is invalid.</p>';
            echo '<p class="error">Please just use letters and space character. Max length is 50.</p>';
        }
        // Invalid region error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidregion"){
            echo '<p class="error">This park region name is invalid.</p>';
            echo '<p class="error">Please only use letters, numbers and -&\' characters. Max length is 50.</p>';
        }
        // Invalid city error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidcity"){
            echo '<p class="error">This park city name is invalid.</p>';
            echo '<p class="error">Please only use letters, numbers and -&\' characters. Max length is 50.</p>';
        }
        // Invalid address error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidaddress"){
            echo '<p class="error">This park address is invalid.</p>';
            echo '<p class="error">Please only use letters, numbers and -&\' characters. Max length is 100.</p>';
        }
        // Invalid postal code error
        else if(isset($_GET['error']) && $_GET['error'] == "invalidpostal"){
            echo '<p class="error">This park postal code is invalid.</p>';
            echo '<p class="error">Please only use letters, numbers and -&\' characters. Max length is 10.</p>';
        }
        // SQL error
        else if(isset($_GET['error']) && $_GET['error'] == "sqlerror"){
            echo '<p class="error">Oops. Something went wrong!</p>';
            echo '<p class="error">We have some issues about storing results. Error '.mysqli_errno($conn).'</p>';
        }
        // Uploaded image exist error
        else if(isset($_GET['error']) && $_GET['error'] == "imageexist"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, some of the images already exist.</p>';
        }
        // Image is too large error
        else if(isset($_GET['error']) && $_GET['error'] == "toolargeimage"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, some of the images are too large to upload.</p>';
        }
        // Image type is not supported error
        else if(isset($_GET['error']) && $_GET['error'] == "imagetype"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, some of the images\' format weren\'t supported.</p>';
            echo '<p class="error">Only JPG, PNG & JPEG image formats are allowed.</p>';
        }
        // Image upload error
        else if(isset($_GET['error']) && $_GET['error'] == "uploaderrorimg"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, some of the images\' upload failed.</p>';
        }
        // Uploaded video exist error
        else if(isset($_GET['error']) && $_GET['error'] == "videoexist"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, video already exists.</p>';
        }
        // Video is too large error
        else if(isset($_GET['error']) && $_GET['error'] == "toolargevideo"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, video is too large to upload.</p>';
        }
        // Video type is not supported error
        else if(isset($_GET['error']) && $_GET['error'] == "videotype"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, video format wasn\'t supported.</p>';
            echo '<p class="error">Only MP4, AVI & GIF video formats are allowed.</p>';
        }
        // Video upload error
        else if(isset($_GET['error']) && $_GET['error'] == "videouploaderror"){
            echo '<p class="success">Park successfully added into ParkRater!</p>';
            echo '<p class="error">However, video upload failed.</p>';
        }
      ?>

        <!--Input for park name, type=text-->
        <div>
            <p>*Name of the park:</p>
            <input
            type="text"
            name="park-name"
            id="parkName"
            placeholder="Park name"
            pattern="^([a-zA-Z0-9 ]+[-&'.]*)+$"
            title="Only letters, numbers and -&'. characters. Max letters is 50."
            maxlength="50"
            value="<?php if(isset($_REQUEST['parkName'])) echo $_REQUEST['parkName'];?>"
            required
            />
        </div>

        <!--Input/textarea for park description, type=textarea-->
        <div>
            <p>Description:</p>
            <textarea
            rows="3"
            cols="30"
            maxlength="500"
            name="park-description"
            id="parkDescription"
            placeholder="Description (max 500 words)"
            value="<?php if(isset($_REQUEST['parkDescription'])) echo $_REQUEST['parkDescription'];?>"
            ></textarea>
        </div>

        <hr />

        <!--Input for park coordinates, type=number-->
        <div>
            <h4>*Coordinates (input or location)</h4>
            <p>Latitude:</p>
            <input
            type="number"
            step="00.0000001"
            min="-90"
            max="90"
            name="park-latitude"
            id="parkLatitude"
            placeholder="Latitude (00.0000000)"
            pattern="^([0-9]{1,2}\.[0-9]{3,7})$"
            title="Min: -90, Max:90, Decimal max:7, 00.0000000"
            value="<?php if(isset($_REQUEST['parkLatitude'])) echo $_REQUEST['parkLatitude'];?>"
            required
            />
        </div>
        <br />
        <div>
            <p>Longitude:</p>
            <input
            type="number"
            step="0.0000001"
            min="-180"
            max="180"
            name="park-longitude"
            id="parkLongitude"
            placeholder="Longitude (00.0000000)"
            pattern="^([0-9]{1,2}\.[0-9]{3,7})$"
            title="Min: -180, Max:180, Decimal max:7, 00.0000000"
            value="<?php if(isset($_REQUEST['parkLongitude'])) echo $_REQUEST['parkLongitude'];?>"
            required
            />
        </div>
        <br />
        <div>
            <p>Current Location:</p>
            <input
            type="submit"
            value="Get location"
            class="searchButton"
            aria-pressed="false"
            onclick="getLocation()"
            />
            <p id="locationError" class="error"></p>
        </div>
        <hr />

        <!-- Input for park country, type=text -->
        <div>
            <p>Country:</p>
            <input
            type="text"
            name="park-country"
            id="parkCountryInput"
            placeholder="Country"
            pattern="[a-zA-Z ]{2,}"
            title="Please just use letters and space character. Max length is 50."
            value="<?php if(isset($_REQUEST['parkCountry'])) echo $_REQUEST['parkCountry'];?>"
            maxlength="50"
            />
        </div>
        <br />

        <!-- Input for park region, type=text -->
        <div>
            <p>Region/State:</p>
            <input
            type="text"
            name="park-region"
            id="parkRegionInput"
            placeholder="Region/State"
            pattern="^([a-zA-Z0-9 ]+[-&']*)+$"
            title="Please only use letters, numbers and -&' characters. Max length is 50."
            value="<?php if(isset($_REQUEST['parkRegion'])) echo $_REQUEST['parkRegion'];?>"
            maxlength="50"
            />
        </div>
        <br />

        <!-- Input for park city, type=text -->
        <div>
            <p>City:</p>
            <input
            type="text"
            name="park-city"
            id="parkCityInput"
            placeholder="City"
            pattern="^([a-zA-Z0-9 ]+[-&']*)+$"
            title="Please only use letters, numbers and -&' characters. Max length is 50."
            value="<?php if(isset($_REQUEST['parkCity'])) echo $_REQUEST['parkCity'];?>"
            maxlength="50"
            />
        </div>
        <br />

        <!-- Input for park address, type=text -->
        <div>
            <p>Address:</p>
            <input
            type="text"
            name="park-address"
            id="parkAddressInput"
            placeholder="Address (Street and number)"
            pattern="^([a-zA-Z0-9 ]+[-&'.,]*)+$"
            title="Please only use letters, numbers and -&'., characters. Max length is 100."
            value="<?php if(isset($_REQUEST['parkAddress'])) echo $_REQUEST['parkAddress'];?>"
            maxlength="100"
            />
        </div>
        <br />

        <!-- Input for park postal code, type=text -->
        <div>
            <p>Postal Code:</p>
            <input
            type="text"
            name="park-postal-code"
            id="parkPostalCodeInput"
            placeholder="Postal Code"
            pattern="^([a-zA-Z0-9 ]+[-&']*)+$"
            title="Please only use letters, numbers and -&' characters. Max length is 10."
            value="<?php if(isset($_REQUEST['parkPostal'])) echo $_REQUEST['parkPostal'];?>"
            maxlength="10"
            />
        </div>

        <hr />

        <!--Input for park image, type=file, accept=image-->
        <div>
            <p>Image:</p>
            <input type="file" accept="image/*" name="park-image[]" id="parkImage"  multiple />
        </div>
        <br />

        <!--Input for park video, type=file, accept=video-->
        <div>
            <p>Video:</p>
            <input type="file" accept="video/*" name="park-video" id="parkVideo" />
        </div>

        <hr />

        <br />
        <!--Input for submitting the form, type=submit-->
        <div>
            <input
            type="submit"
            value="Submit"
            name="park-submit"
            class="submissionButton"
            aria-pressed="false"
            />
        </div>
    </form>
    <br />
    <br />
</main>

<?php
    require "footer.php";
?>