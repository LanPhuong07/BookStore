<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
session_unset();
session_destroy();

?>
<script>
document.location="../index.php";
</script>
