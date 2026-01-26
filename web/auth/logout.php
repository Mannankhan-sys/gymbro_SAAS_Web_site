<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Public_Home_Page/index.html");
exit;
?>