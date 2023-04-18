<!DOCTYPE html>
<html lang="en">
<body>
<?php
$name = "Empty";

if (!empty($_GET['name'])) {
    $name = $_GET['name'];
}
?>
<h1><?= $name ?></h1>
<form action="getEX.php" method="get">
    <input type="text" name="name" placeholder="name">
    <input type="submit" value="Submit">
</form>
</body>
