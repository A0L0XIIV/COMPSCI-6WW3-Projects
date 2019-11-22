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
      >

      <?php
        // Successfully registered
        if(isset($_GET['submission']) && $_GET['submission'] == "success"){
            echo '<p class="success">Submission successful!</p>';
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
            pattern="^([a-zA-Z0-9 ]+[-&']*)+$"
            title="Only letters, numbers and -&' characters. Max letters is 50."
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
            title="Please just use letters and space character."
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
            pattern="^([a-zA-Z0-9 ]+[-&']*)+$"
            title="Please only use letters, numbers and -&' characters. Max length is 100."
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
            name="park-postal"
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
            <input type="file" accept="image/*" name="park-image" id="parkImage" />
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