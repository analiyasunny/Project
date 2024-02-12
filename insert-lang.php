<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$title = 'Adding new language';
include('shared/header.php');

$Language=$_POST['Language'];
echo $Language;
$NativeSpeakers=$_POST['NativeSpeakers'];
$Country=$_POST['Country'];
$linguisticage=$_POST['linguisticage'];


include('shared/db.php');

$sql = "INSERT INTO Language (Language, NativeSpeakers, Country, linguisticage) VALUES (:Language, :NativeSpeakers, :Country, :linguisticage)";

$cmd = $db->prepare($sql);

$cmd->bindParam(':Language', $Language, PDO::PARAM_STR, 100);
$cmd->bindParam(':NativeSpeakers', $NativeSpeakers, PDO::PARAM_STR, 100);
$cmd->bindParam(':Country', $Country, PDO::PARAM_STR, 50);
$cmd->bindParam(':linguisticage', $linguisticage, PDO::PARAM_STR, 100);

$cmd->execute();

$db = null;

echo ' Language added ';

?>
</body>
</html>
