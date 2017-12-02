<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id App</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/main.css">
    <script src="scripts/cardprocess.js" defer></script>
</head>
<body>
<?php if(isset($_SESSION['errorProfile'])){ ?>
    <p class="error"><?=$_SESSION['errorProfile']?></p>
<?php } ?>
<?php if(isset($_SESSION['errorBackground'])){ ?>
    <p class="error"><?=$_SESSION['errorBackground']?></p>
<?php } ?>
<?php
    $instance = connectDB::getInstance();
    $dbh = $instance->getConnection();

    $stmt = $dbh->prepare('SELECT cardname FROM cards');
    $stmt->execute();
    $result=$stmt->fetchAll();

    if(!empty($result)) {
?>
    <label>Select One of your previous cards:
        <select name="savedcards" id="savedcards">
            <option value="nocard">No Card Selected</option>
            <?php
                for($i = 0; $i<count($result);$i++){
             ?>
                <option value="<?=$result[$i]['cardname']?>"><?=$result[$i]['cardname']?></option>
             <?php
                }
            ?>
        </select>
    </label>
<?php
    }
?>
<form action="action_saveid.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Card Preview</legend>
        <div class="card_area">
            <img src="images/default_avatar.jpeg" width="200" height="200">
            <ul>
                <li class="id_name">Your Name here</li>
                <li class="id_job">Your Job Position</li>
                <li class="id_company">Your Company Name here</li>
                <li class="id_email">Your Email here</li>
            </ul>
            <p class="id_description">You can add a description here.</p>
        </div>
    </fieldset>
    <fieldset>
        <legend>Drop Images</legend>
        <div id="drop_photo">
            <strong>Drop Photo</strong>
        </div>
        <input type="hidden" name="profilePhoto" id="profilePhoto">
        <div id="drop_background">
            <strong>Drop Background</strong>
        </div>
        <input type="hidden" name="backgroundImage" id="backgroundImage">
    </fieldset>
    <fieldset>
        <legend>Text Fields</legend>
        <label>Card Name:
            <input type="text" name="cardname" id="id_cardname" class="textinput" placeholder="Give your card a name" required>
        </label>
        <label>Name:
            <input type="text" name="name" id="id_name" class="textinput" placeholder="Your Name" required>
        </label>
        <label>Job:
            <input type="text" name="job" id="id_job" class="textinput" placeholder="Your Job" required>
        </label>
        <label>Company:
            <input type="text" name="company" id="id_company" class="textinput" placeholder="Your Company" required>
        </label>
        <label>Email:
            <input type="email" name="email" id="id_email" class="textinput" placeholder="Your email" required>
        </label>
        <label>Description:
            <input type="text" name="description" id="id_description" class="textinput" placeholder="Something about yourself" required>
        </label>
        <label>Background size:
            <select name="backgroundSize" id="id_backgroundsize">
                <option value="auto">Auto</option>
                <option value="contain">Contain</option>
                <option value="cover">Cover</option>
            </select>
        </label>
        <label>Text Color:
            <select name="textColor" id="id_textcolor">
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="darkgrey">darkgrey</option>
                <option value="navy">navy</option>
                <option value="red">red</option>
                <option value="purple">purple</option>
            </select>
        </label>
        <input type="submit" value="Save New Card">
        <button type="button">Generate JSON</button>
    </fieldset>
    <fieldset>
        <legend>Output</legend>
        <code class="JSONoutput"></code>
    </fieldset>
</form>
</body>
</html>