<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>index</title>


    <style>
        .center{
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        ul {
            list-style-type: none;
        }
    </style>

    <h1 class="center">To-Do List</h1>


</head>

<body>

    <?php

    //running the file to connect to database
    require 'connect.php';

    //add items to database
    if (!empty($_GET['Add'])) {
        $item = $_GET['item'];
        try {
            $redis->set($item, $item);
        } catch (RedisException $e) {
            echo ($e);
        }
    }
    //delete items from data base
    if (!empty($_GET['submit'])) {
        $redis-> del($_GET['submit']);
    }
    ?>
    <div class="center">
        <ul>
            <?php
            // Get all keys in the database
            try {
                $keys = $redis->keys('*');

                if($keys != null){
                    foreach ($keys as $key){
                        $value = $redis->get($key);
                        echo "<form method='get' action='index.php'><a>$value </a><button type='submit' name='submit' value='$value'>X</button></form>";
                    }
                }
                else{
                    echo "<h1>Empty</h1>";
                }
            } catch (RedisException $e) {
                echo $e;
            }
            ?>
        </ul>
    </div>

    <div class="center">
        <form method="get" action="index.php">
            <label for="item">Add Task:</label>
            <input type="text" id="item" name="item">
            <input type="submit" name="Add" value="Add"/>
        </form>
    </div>
</body>