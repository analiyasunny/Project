<?php
// read the showId from the url parameter using $_GET   
$languageId = $_GET['languageId'];

if (is_numeric($languageId)) {
    include('shared/auth.php');
    try {
    // connect to db
    include('shared/db.php');

    // prepare SQL DELETE
    $sql = "DELETE FROM Language WHERE languageId = :languageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':languageId', $languageId, PDO::PARAM_INT);

    // execute the delete
    $cmd->execute();

    // disconnect
    $db = null;

    // show a message (temporarily)
    echo 'Language Deleted';

    // redirect back to updated shows.php (eventually)
    header('location:lang-table.php');
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
}
?>