<?php
    include_once('includes/init.php');

    $cardName = $_POST['cardname'];
    $idName = $_POST['name'];
    $job = $_POST['job'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $backgroundSize = $_POST['backgroundSize'];
    $textColor = $_POST['textColor'];
    $profilePic = $_POST['profilePhoto'];
    $backgroundPic = $_POST['backgroundImage'];

    if(empty($profilePic)){
        $_SESSION['errorProfile']='Please select one profile image';
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        die();
    }

    if(empty($backgroundPic)){
        $_SESSION['errorBackground']='Please select one background image';
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        die();
    }

    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $stmt = $dbh->prepare('SELECT id FROM cards');
    $stmt->execute();
    $result=$stmt->fetchAll();
    $resultplusone = count($result)+1;

    $cardName = $_POST['cardname'] . "_{$resultplusone}";
    $profilePicFileName = 'images/profile/'. $_POST['cardname'] . "_{$resultplusone}.jpg";
    $backgroundPicFileName = 'images/background/'. $_POST['cardname'] . "_{$resultplusone}.jpg";

    $stmt = $dbh->prepare('INSERT INTO cards VALUES (NULL,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array(   $cardName,
                            $idName,
                            $job,
                            $company,
                            $email,
                            $description,
                            $profilePicFileName,
                            $backgroundPicFileName,
                            $backgroundSize,
                            $textColor
                            ));


    /*SAVE PROFILE PICTURE */
    $profile = $profilePic;
    $profile_exploded=explode(',', $profile);
    //print_r($profile_exploded[0]);
    //die();
    $imagedecoded = base64_decode($profile_exploded[1]);
    //print_r($imagedecoded);
    $filepath = $profilePicFileName;
    file_put_contents($filepath, $imagedecoded);

    /*SAVE BACKGROUND PICTURE */
    $background = $backgroundPic;
    $background_exploded=explode(',', $background);
    //print_r($profile_exploded[0]);
    //die();
    $imagedecoded = base64_decode($background_exploded[1]);
    //print_r($imagedecoded);
    $filepath = $backgroundPicFileName;
    file_put_contents($filepath, $imagedecoded);


    header('Location: ' . $_SERVER['HTTP_REFERER'] );
    die();

    /*


    echo 'done';

    //print_r($profile_exploded); */

/*DEBUG
$stmt = $dbh->prepare('SELECT * FROM cards');
$stmt->execute();
$result=$stmt->fetchAll();*/


/*
echo $cardName;
echo '<br>';
echo '<br>';
echo $idName;
echo '<br>';
echo '<br>';
echo $job;
echo '<br>';
echo '<br>';
echo $company;
echo '<br>';
echo '<br>';
echo $email;
echo '<br>';
echo '<br>';
echo $description;
echo '<br>';
echo '<br>';
echo $backgroundSize;
echo '<br>';
echo '<br>';
echo $textColor;
echo '<br>';
echo '<br>';
echo $profilePic;
echo '<br>';
echo '<br>';
echo $backgroundPic;

*/


?>