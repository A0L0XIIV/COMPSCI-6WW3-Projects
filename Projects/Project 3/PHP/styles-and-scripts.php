<?php
// CSS and JS files path
$cssDir = "../CSS/";
$jsDir = "../JS/";

// Individual stylesheets
$styles = [
    'index.php' => 'index.css',
    'individual_sample.php' => 'individual_sample.css',
    'login.php' => 'login.css',
    'registration.php' => 'registration.css',
    'result_sample.php' => 'result_sample.css',
    'search.php' => 'search.css',
    'submission.php' => 'submission.css',
];
// Individual script files
$scripts = [
    'individual_sample.php' => 'individual_sample.js',
    'registration.php' => 'registration.js',
    'result_sample.php' => 'result_sample.js',
    'search.php' => 'search.js',
    'submission.php' => 'search.js',
];
// Individual page titles
$titles = [
    'index.php' => '',
    'individual_sample.php' => 'Park - ',
    'login.php' => 'Login - ',
    'registration.php' => 'Sign Up - ',
    'result_sample.php' => 'Search Results - ',
    'search.php' => 'Park Search - ',
    'submission.php' => 'Add a New Park - ',
];
// Get PHP file name
$this_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Common stylesheets -->
<link rel="stylesheet" type="text/css" href="<?="$cssDir/main.css"?>">
<!-- CSS, specific to the current page -->
<link rel="stylesheet" type="text/css" href="<?="$cssDir/$styles[$this_page]"?>">

<!-- Common scripts -->
<script type="text/javascript" src="<?="$jsDir/main.js"?>"></script>
<!-- JS, specific to the current page -->
<script type="text/javascript" src="<?="$jsDir/$scripts[$this_page]"?>"></script>

<!-- Title of the page -->
<?php
     echo '<title>'.$titles[$this_page].'ParkRater</title>';
?>
