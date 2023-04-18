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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item = $_POST['item'];
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

    try {
        $keys = $redis->keys('*');

        if($keys != null){
            foreach ($keys as $key){
                $value = $redis->get($key);
                if($value != ""){
                    $arr[] = $value;
                }
            }
        }
    } catch (RedisException $e) {
        echo $e;
    }
    ?>
    <div class="center">
        <ul>
            <?php
            // Get all keys in the database
            if(!empty($arr)) {
                foreach ($arr as $i) {
                    echo "<form method='get' action='index.php'><a>$i </a><button type='submit' name='submit' value='$i'>X</button></form>";
                }
            }
            else{
                    echo "<h1>Empty</h1>";
                }
            ?>
        </ul>
    </div>

    <div class="center">
        <form method="post" action="index.php">
            <label for="item">Add Task:</label>
            <input type="text" id="item" name="item">
            <input type="submit" name="Add" value="Add"/>
        </form>
    </div>
</body>
