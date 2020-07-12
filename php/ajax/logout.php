<!-- This file is only used for a ajax request. This file will changed the session loggedIn variable to False so the application knows the user is not logged in anymore -->
<?php
session_start();
$_SESSION["loggedIn"] = "no";
?>