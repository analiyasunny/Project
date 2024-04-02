<?php
$title = 'Saving Language Updates...';
include('shared/auth.php');
include('shared/header.php');

// capture form inputs into vars
$languageId = $_POST['languageId'];  // id value from hidden input on form
$Language = $_POST['Language'];
$NativeSpeakers = $_POST['NativeSpeakers'];
$Country = $_POST['Country'];
$linguisticage = $_POST['linguisticage'];
$ok = true;

// input validation before save
if (empty($Language)) {
    echo 'Language is required<br />';
    $ok = false;
}

if (empty($NativeSpeakers)) {
    echo 'Native Speakers is required<br />';
    $ok = false;
}
if (empty($Country)) {
    echo 'Country is required<br />';
    $ok = false;
}

if (empty($linguisticage)) {
    echo 'linguisticage is required<br />';
    $ok = false;
}

// process photo if any
if ($_FILES['photo']['size'] > 0) { 
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    //echo $finalName . '<br />';

    // in php, file size is bytes (1 kb = 1024 bytes)
    $size = $_FILES['photo']['size']; 
    //echo $size . '<br />';

    // temp location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];
    //echo $tmp_name . '<br />';

    // file type
    // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
    $type = mime_content_type($tmp_name);
    //echo $type . '<br />';

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }     
}
else {
    // no new photo uploaded, keep current photo set in hidden input on form
    // this prevents an existing photo being set to null and removed
    $finalName = $_POST['currentPhoto'];
}

if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');

    // set up SQL UPDATE command
    $sql = "UPDATE Language SET Language = :Language, NativeSpeakers = :NativeSpeakers, 
        Country = :Country, linguisticage = :linguisticage, photo = :photo WHERE languageId = :languageId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':Language', $Language, PDO::PARAM_STR, 100);
    $cmd->bindParam(':NativeSpeakers', $NativeSpeakers, PDO::PARAM_STR, 100);
    $cmd->bindParam(':Country', $Country, PDO::PARAM_STR, 50);
    $cmd->bindParam(':linguisticage', $linguisticage, PDO::PARAM_STR, 100);
    $cmd->bindParam(':languageId', $languageId, PDO::PARAM_INT);
    $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

    // execute the update (which saves to the db)
    $cmd->execute();

    // disconnect
    $db = null;

    // show msg to user
    echo 'Language Updated';
}
?>
</main>
</body>
</html>
