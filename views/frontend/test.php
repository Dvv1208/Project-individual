<?php

// non-logged in user shouldn't access this page
if (!isset($_SESSION['uid'])) {
    header('Location: index.php?option=customer&login');
}

// log out the user and redirect to login page
if (isset($_GET['action']) && ('logout' == $_GET['action'])) {
    unset($_SESSION['uid']);
    header('Location: index.php?option=customer&login');
}

require_once("config/db-google.php");

$db = new DB();
$user = $db->get_user($_SESSION['uid']);

echo "Welcome " . $user['Fullname'];
echo "<p><a href='index.php?action=logout'>Log out</a></p>";
