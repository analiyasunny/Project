<?php
$title = 'Adding new language';
include('shared/header.php');

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
    $sql = "INSERT INTO Language (Language, NativeSpeakers, Country, linguisticage) VALUES (:Language, :NativeSpeakers, :Country, :linguisticage)";

    //linking db connection w/SQL command 
    $cmd = $db->prepare($sql);

    //mapping each input to the Language table
    $cmd->bindParam(':Language', $Language, PDO::PARAM_STR, 100);
    $cmd->bindParam(':NativeSpeakers', $NativeSpeakers, PDO::PARAM_STR, 100);
    $cmd->bindParam(':Country', $Country, PDO::PARAM_STR, 50);
    $cmd->bindParam(':linguisticage', $linguisticage, PDO::PARAM_STR, 100);

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
