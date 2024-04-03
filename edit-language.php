<?php 
$title = 'Edit Language';
include('shared/auth.php');
include('shared/header.php'); 

// get the languageId from the URL parameter using $_GET
$languageId = $_GET['languageId'];

// initialize variables
$Language = null;
$NativeSpeakers = null;
$Country = null;
$linguisticage = null;


if (is_numeric($languageId)) {

    try {
    include('shared/db.php');

    $sql = "SELECT * FROM Language WHERE languageId = :languageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':languageId', $languageId, PDO::PARAM_INT);
    $cmd->execute();
    $Language = $cmd->fetch(PDO::FETCH_ASSOC);

  
    $LanguageName = $Language['Language'];
    $NativeSpeakers = $Language['NativeSpeakers'];
    $Country = $Language['Country'];
    $linguisticage = $Language['linguisticage'];
    $photo = $Language['photo'];  // fill var w/Language photo name if there is one
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
}

?>

<h2>World Languages and Speakers</h2>
<form method="post" action="update-lang.php" enctype="multipart/form-data">
    <fieldset>
        <label for="Language">Language: *</label>
        <input name="Language" id="Language" required value="<?php echo htmlspecialchars($LanguageName); ?>"/>
    </fieldset>
    <fieldset>
        <label for="NativeSpeakers">Native Speakers: *</label>
        <input name="NativeSpeakers" id="NativeSpeakers" required value="<?php echo htmlspecialchars($NativeSpeakers); ?>"/>
    </fieldset>
    <fieldset>
        <label for="Country">Country: *</label>
        <input name="Country" id="Country" required value="<?php echo htmlspecialchars($Country); ?>" /> 
    </fieldset>
    <fieldset>
        <label for="linguisticage">Linguistic age: *</label>
        <select name="linguisticage" id="linguisticage" required>
            <?php
           
            $sql = "SELECT * FROM Lingusticage ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $Lingusticage = $cmd->fetchAll(PDO::FETCH_ASSOC);
            foreach ($Lingusticage as $Lingusticages) {
                if ($Lingusticages['name'] == $linguisticage) {
                    echo '<option selected>' . htmlspecialchars($Lingusticages['name']) . '</option>';
                } else {
                    echo '<option>' . htmlspecialchars($Lingusticages['name']) . '</option>';
                }
            }
            ?>
        </select> 
    </fieldset>
    <input type="hidden" name="languageId" id="languageId" value="<?php echo $languageId; ?>" />
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" />
        <input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>" />
        <?php
        if ($photo != null) {
            echo '<img src="img/uploads/' . $photo . '" alt="Language Photo" />';
        }
        ?>
    </fieldset>
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>
