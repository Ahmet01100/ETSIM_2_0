<?php
    $host_name  = "db596949605.db.1and1.com";
    $database   = "db596949605";
    $user_name  = "dbo596949605";
    $password   = "Welcome68Utbm";

    /*
    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    if (mysqli_connect_errno())
    {
    echo "La connexion au serveur MySQL n'a pas abouti : " . mysqli_connect_error();
    }
    */
    try{
        $connect = new PDO ('mysql:host='.$host_name.';dbname='.$database, $user_name,$password);
        $connect->exec("SET CHARACTER SET utf8");
        }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
?>