</head>
<body onload="init()">
    <header class="row">
        <!-- Site Logo w/ index.html link-->
        <div class="col-3 d-none d-sm-block" id="headerLogoDiv">
            <a href="./index.php">
                <picture id="websiteLogo">
                    <source media="(min-width: 800px)" id="websiteLogoBig" srcset="../Images/Logos/Logo.png">
                    <img src="../Images/Logos/LogoSmall.png" alt="ParkRater Logo" id="websiteLogoSmall" aria-label="ParkRater Logo">
                </picture>
            </a>
        </div>

        <!-- Center div of the header: Name of the website and navbar -->
        <div class="col-6" id="headerNavDiv">
            <!-- Website name and Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" id="websiteName" href="./index.php">ParkRater</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <form action="./individual_sample.php" method="get" class="nav-item navButton">
                                <input type="submit" value="Random Park" name="get-park" aria-pressed="false"/>
                                <input type="text" value="random" name="id" hidden />
                            </form>
                        </li>
                        <li class="nav-item active">
                            <form action="./search.php" class="nav-item navButton">
                                <input type="submit" value="Search Parks" aria-pressed="false"/>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form action="./submission.php" class="nav-item navButton">
                                <input type="submit" value="New Park" aria-pressed="false"/>
                            </form>
                        </li>
                            <?php
                                if(isset($_SESSION['userId'])){
                                    echo '<li class="nav-item">
                                            <form action="includes/logout.inc.php" class="nav-item navButton">
                                                <input type="submit" value="Logout" aria-pressed="false"/>
                                            </form>
                                        </li>';
                                }
                                else{
                                    echo '<li class="nav-item">
                                            <form action="./registration.php" class="nav-item navButton">
                                                <input type="submit" value="Sign Up" aria-pressed="false"/>
                                            </form>
                                        </li>
                                        <li class="nav-item">
                                            <form action="./login.php" class="nav-item navButton">
                                                <input type="submit" value="Login" aria-pressed="false"/>
                                            </form>
                                        </li>';
                                }
                            ?>
                        </ul> 
                </div>
            </nav>
        </div>

        <!-- Search bars -->
        <div class="col-3  d-none d-sm-block" id="headerSearchDiv" role="search">
            <!-- Search bar and its button -->
            <form 
                class="row"
                name="name-search-form" 
                action="includes/search.inc.php" 
                method="post">
                <div class="col-8 pr-0">
                    <input
                        type="search"
                        name="park-name"
                        class="searchBox"
                        placeholder=" Enter a park name..."
                    />
                </div>
                <div class="col-4 pl-0">
                    <input
                        type="submit"
                        value="Search"
                        name="name-search-submit"
                        class="searchButton"
                        aria-pressed="false"
                    />
                </div>
            </form>
        </div>
    </header>
