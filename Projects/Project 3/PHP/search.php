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
            <a href="./search.php">Search Parks</a>
          </li>
        </ul>
      </div>

      <!-- Search errors -->
      <?php
          // Empty search field
          if(isset($_GET['error']) && $_GET['error'] == "emptyfield"){
              echo '<p class="error">Please fill the search criteria.</p>';
          }
          // SQL error
          else if(isset($_GET['error']) && $_GET['error'] == "sqlerror"){
            echo '<p class="notFound">Oops. Something went wrong!</p>';
            echo '<p class="notFound">We have some issues about SQL DB.</p>'; 
          }
          // No park found
          else if(isset($_GET['error']) && $_GET['error'] == "noparkfound"){
              echo '<p class="error">Sorry, we couldn\'t find any park.</p>';
          }
      ?>

      <!-- Search with park name part -->
      <div>
        <h4>Search with park name</h4>
        <form 
          name="name-search-form" 
          action="includes/search.inc.php" 
          method="post">
          <input
            type="search"
            name="park-name"
            class="searchBox"
            placeholder="Name of the park"
            required
          />
          <br />
          <br />
          <input
            type="submit"
            value="Search by name"
            name="name-search-submit"
            class="searchButton"
            aria-pressed="false"
          />
        </form>
      </div>

      <hr />

      <!-- Search with rating part -->
      <div>
        <h4>Search with rating</h4>
        <form 
          name="rating-search-form" 
          action="includes/search.inc.php" 
          method="post">
          <select name="park-rating">
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
          <input
            type="submit"
            value="Search by rating"
            name="rating-search-submit"
            class="searchButton"
            aria-pressed="false"
          />
        </form>
      </div>

      <hr />

      <!-- Search with location -->
      <div>
        <h4>Search with current location</h4>
        <form 
          name="location-search-form"
          id="locationSearchForm" 
          action="includes/search.inc.php" 
          method="post"
          >
          <div>
              <input
              type="submit"
              value="Get location"
              class="searchButton"
              aria-pressed="false"
              onclick="getLocation()"
              />
              <p id="locationError" class="error"></p>
          </div>
          <div>
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
          <input
            type="submit"
            value="Search with location"
            name="location-search-submit"
            class="searchButton"
            aria-pressed="false"
          />
        </form>
        <p id="locationError" class="error"></p>
      </div>
      <br />
      <br />
    </main>

<?php
    require "footer.php";
?>