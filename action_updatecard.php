<?php
    include_once('includes/init.php');

    $cardname = $_GET['cardname'];

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $stmt = $dbh->prepare('SELECT * FROM cards WHERE cardname=?');
    $stmt->execute(array("$cardname"));
    $result=$stmt->fetchAll();

    echo json_encode($result);
?>