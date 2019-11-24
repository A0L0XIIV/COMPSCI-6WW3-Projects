</head>
<body onload="init()">
    <header class="flexContainer">
        <!-- Site Logo w/ index.html link-->
        <div class="headerFlexItemLogo" id="headerLogoDiv">
            <a href="./index.php">
                <picture id="websiteLogo">
                    <source media="(min-width: 800px)" id="websiteLogoBig" srcset="../Images/Logos/Logo.png">
                    <img src="../Images/Logos/LogoSmall.png" alt="ParkRater Logo" id="websiteLogoSmall" aria-label="ParkRater Logo">
                </picture>
            </a>
        </div>

        <!-- Center div of the header: Name of the website and navbar -->
        <div class="headerFlexItemNav" id="headerNavDiv">
            <!-- Website name -->
            <div class="headerSiteName" id="websiteName">
                <a href="./index.php">ParkRater</a>
            </div>

            <!-- Navbar and its linked buttons -->
            <nav class="gridContainer">
                <form action="./individual_sample.php" class="navButton">            <!-- RANDOM ID !!!!!!!!!!!!!!!!!! -->
                    <input type="submit" value="Random Park" aria-pressed="false"/><!-- SELECT * FROM `park` ORDER BY ABS(`park_id` - 2) -->
                </form>
                <form action="./search.php" class="navButton">
                    <input type="submit" value="Search Parks" aria-pressed="false"/>
                </form>
                <form action="./submission.php" class="navButton">
                    <input type="submit" value="New Park" aria-pressed="false"/>
                </form>
                <?php
                    if(isset($_SESSION['userId'])){
                        echo '<form action="includes/logout.inc.php" class="navButton">
                        <input type="submit" value="Logout" aria-pressed="false"/>
                    </form>';
                    }
                    else{
                        echo '<form action="./registration.php" class="navButton">
                        <input type="submit" value="Sign Up" aria-pressed="false"/>
                    </form>
                    <form action="./login.php" class="navButton">
                        <input type="submit" value="Login" aria-pressed="false"/>
                    </form>';
                    }
                ?> 
            </nav>
        </div>

        <!-- Search bars -->
        <div class="headerFlexItemSearch gridContainer" id="headerSearchDiv" role="search">
            <div></div>
            <!-- Search bar and its button -->
            <div class="searchWithName">
                <form 
                    name="name-search-form" 
                    action="includes/search.inc.php" 
                    method="post">
                    <input
                        type="search"
                        name="park-name"
                        class="searchBox"
                        placeholder=" Enter a park name..."
                    />
                    <input
                        type="submit"
                        value="Search"
                        name="name-search-submit"
                        class="searchButton"
                        aria-pressed="false"
                    />
                </form>
            </div>
            <!-- Search w/ rating dropdown and its button -->
            <div class="searchWithRate">
                <form 
                    name="rating-search" 
                    action="includes/search.inc.php" 
                    method="post">
                    <select name="park-rating">
                        <option value="" hidden selected>Select rating...</option>
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
                    <input
                        type="submit"
                        value="Search"
                        name="rating-search-submit"
                        class="searchButton"
                        aria-pressed="false"
                    />
                </form>
            </div>
        </div>
    </header>
