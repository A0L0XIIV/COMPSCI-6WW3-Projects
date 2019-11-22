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

      <!-- Search with park name part -->
      <div>
        <h4>Search with park name</h4>
        <form 
        name="name-search" 
        action="includes/search.inc.php" 
        method="post">
          <input
            type="search"
            name="search-park-name"
            class="searchBox"
            placeholder="Name of the park"
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
        name="rank-search" 
        action="includes/search.inc.php" 
        method="post">
          <select>
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
        name="location-search" 
        action="includes/search.inc.php" 
        method="post">
          <input
              type="number"
              name="parkLatitude"
              id="parkLatitude"
              placeholder="Latitude (00.0000000)"
              hidden
            />
          <input
              type="number"
              name="parkLongitude"
              id="parkLongitude"
              placeholder="Longitude (00.0000000)"
              hidden
            />
          <input
            type="submit"
            value="Search by location"
            name="location-search-submit"
            class="searchButton"
            aria-pressed="false"
            onclick="getLocation()"
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