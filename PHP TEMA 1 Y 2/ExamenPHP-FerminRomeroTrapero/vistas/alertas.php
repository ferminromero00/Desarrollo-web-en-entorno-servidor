
<?php
if (!isset($_SESSION["alerta"])) {
    $_SESSION["alert"] = "";
} else {
    echo $_SESSION["alerta"];
}

?>

