<!DOCTYPE html>
<html lang="en">
<body>
<?php
$name = "Empty";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
}
?>
<h1><?= $name ?></h1>
<form action="postEX.php" method="post">
    <input type="text" name="name" placeholder="name">
    <input type="submit" value="Submit">
</form>
</body>

