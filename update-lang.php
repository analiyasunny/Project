<?php
$title = 'Saving Language Updates...';
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

if ($ok == true) {
    // connect to db using the PDO (PHP Data Objects Library)
    include('shared/db.php');

    // set up SQL UPDATE command
    $sql = "UPDATE Language SET Language = :Language, NativeSpeakers = :NativeSpeakers, 
        Country = :Country, linguisticage = :linguisticage WHERE languageId = :languageId";

    // link db connection w/SQL command we want to run
    $cmd = $db->prepare($sql);

    // map each input to a column in the shows table
    $cmd->bindParam(':Language', $Language, PDO::PARAM_STR, 100);
    $cmd->bindParam(':NativeSpeakers', $NativeSpeakers, PDO::PARAM_STR, 100);
    $cmd->bindParam(':Country', $Country, PDO::PARAM_STR, 50);
    $cmd->bindParam(':linguisticage', $linguisticage, PDO::PARAM_STR, 100);
    $cmd->bindParam(':languageId', $languageId, PDO::PARAM_INT);

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
