<?php
// check for existence of "install" directory
if (is_dir("install")) {
    header("Location: install/installer.php");
}

?>