<?php
session_start();

/* destroy all sessions */
session_unset();
session_destroy();

/* redirect to homepage */
header("Location: index.php");
exit;
?>