<?php
$title = 'Adding new language';
include('shared/auth.php');
include('shared/header.php');

// process photo if any
if ($_FILES['photo']['size'] > 0) {
    $photoName = $_FILES['photo']['name'];
    $finalName = session_id() . '-' . $photoName;
    echo $finalName . '<br />';

    // in php, file size is bytes (1 kb = 1024 bytes)
    $size = $_FILES['photo']['size']; 
    echo $size . '<br />';

    // temp location in server cache
    $tmp_name = $_FILES['photo']['tmp_name'];
    echo $tmp_name . '<br />';

    // file type
    // $type = $_FILES['photo']['type']; // never use this - unsafe, only checks extension
    $type = mime_content_type($tmp_name);
    echo $type . '<br />';

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Photo must be a .jpg or .png';
        exit();
    }
    else {
        // save file to img/uploads
        move_uploaded_file($tmp_name, 'img/uploads/' . $finalName);
    }
}

$Language=$_POST['Language'];
echo $Language;
$NativeSpeakers=$_POST['NativeSpeakers'];
$Country=$_POST['Country'];
$linguisticage=$_POST['linguisticage'];
$ok=true;

//validating the input
    if(empty($Language)){
       echo 'Language must be filled</br>';
       $ok=false;
}
    if(empty($NativeSpeakers)){
       echo 'NativeSpeakers must be filled</br>';
       $ok=false;
}
    if(empty($Country)){
       echo 'Country must be filled</br>';
       $ok=false;
}
    if(empty($linguisticage)){
       echo 'linguisticage must be filled</br>';
       $ok=false;
}

if($ok==true){
    //including the shared Database
    include('shared/db.php');

    //SQL INSERT command 
    
    $sql = "INSERT INTO Language (Language, NativeSpeakers, Country, linguisticage, photo) 
    VALUES (:Language, :NativeSpeakers, :Country, :linguisticage, :photo)";
    //linking db connection w/SQL command 
    $cmd = $db->prepare($sql);

    //mapping each input to the Language table
    $cmd->bindParam(':Language', $Language, PDO::PARAM_STR, 100);
    $cmd->bindParam(':NativeSpeakers', $NativeSpeakers, PDO::PARAM_STR, 100);
    $cmd->bindParam(':Country', $Country, PDO::PARAM_STR, 50);
    $cmd->bindParam(':linguisticage', $linguisticage, PDO::PARAM_STR, 100);
    $cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

    //execute the INSERT Which saves to the db
    $cmd->execute();

    //disconnet
    $db = null;

    //messaging when the Language is saved
    echo ' Language added ';
}
?>
</body>
</html>