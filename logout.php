<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: ./addr_index.php");
?>