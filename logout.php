<?php require_once('codeblocks/session.php'); ?>
<?php
session_unset();
session_destroy();
header('Location: login.php')
?>