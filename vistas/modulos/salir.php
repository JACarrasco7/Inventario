<?php
$_SESSION = array();
session_destroy();
echo '<script>
        window.location = "ingreso"
    </script>';