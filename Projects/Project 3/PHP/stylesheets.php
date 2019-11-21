<?php
// CSS files path
$cssDir = "../CSS/";

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

?>
<!-- Common stylesheets -->
<!-- <link rel="stylesheet" type="text/css" href="<?="$cssDir/main.css"?>> -->
<!-- CSS, specific to the current page -->
<link rel="stylesheet" type="text/css" href="<?="$cssDir/$styles[$this_page]"?>>