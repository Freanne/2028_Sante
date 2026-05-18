<?php
session_start();
session_unset();
session_destroy();
header('Location: /APP2028/2028_Sante/frontend/index.php');
exit();