<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page with logout flag
header('Location: Login.php?logout=1');
exit();
?>
